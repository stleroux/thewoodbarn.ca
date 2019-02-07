<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use App\Recipe;
use App\Role;
use Auth;
use DB;
use Excel;
use File;
use Log;
use Hash;
use Session;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPWDRequest;

class UserController extends Controller
{

    public function __construct() {
        // only allow authenticated users to access these pages
        //$this->middleware('auth');
        //not needed as control done through routes file

        Log::useFiles(storage_path().'/logs/users.log');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('username','ASC')->get();
        return view('users.index',compact('data'));
            //->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            foreach ($request->input('roles') as $key => $value) {
                $user->attachRole($value);
            }

            // create new row in profile table for this user
            // $profile = new Profile;
            //     $profile->user_id = $user->id;
            // $profile->save();

        Session::flash('success','User created successfully');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $input = $request->all();
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = User::find($id);

        $user->update($input);

        DB::table('role_user')->where('user_id',$id)->delete();
        
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED user (" . $user->id . ")\r\n", 
            [json_decode($user, true)]
        );

        Session::flash('success','User updated successfully');
        return redirect()->route('users.index');
                       
    }

    public function delete($id)
    {
        $user = User::find($id);
        return view('users.delete', compact('user'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // Delete the profile image if any
        File::delete('images/profiles/' . $user->image);
        
        //Delete favorites that this user added to the system
        DB::table('recipe_user')->where('user_id', '=', $user->id)->delete();
        
        // Delete favorites from other users to this user's recipes
        $recipes = Recipe::where('user_id', '=', $user->id)->get();
            foreach ($recipes as $recipe) {
                DB::table('recipe_user')->where('recipe_id', '=', $recipe->id)->delete();
            }
        
        //Delete recipes created by this user
        DB::table('recipes')->where('user_id', '=', $user->id)->delete();

        //Delete the user's roles (if any)
        DB::table('role_user')->where('user_id', '=', $user->id)->delete();

        //Delete posts created by this user
        DB::table('posts')->where('user_id', '=', $user->id)->delete();
        // Comments associated to this post will be automatically deleted from teh DB using a foreign key constraint

// //also need to delete post_tag, post_images, tasks

        // Delete the user
        $user->delete();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED user (" . $user->id . ")\r\n", 
            [json_decode($user, true)]
        );

        Session::flash('success', 'The user was successfully deleted!');
        return redirect()->route('users.index');
    }

    public function exportPDF()
    {
       $data = User::get()->toArray();
       return Excel::create('Users_List', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
            $sheet->fromArray($data);
        });
       })->download("pdf");
    }

    public function import()
    {
        return view('users.import');
    }

    public function downloadExcel($type)
    {
        $data = User::get()->toArray();
        return Excel::create('Users_List', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'name' => $value->name,
                        'email' => $value->email,
                        'password' => $value->password,
                        'created_at' => $value->created_at,
                        'updated_at' => $value->updated_at,
                        ];
                }
                if(!empty($insert)){
                    DB::table('users')->insert($insert);
                    //dd('Insert Record successfully.');
                    Session::flash('Success','Import was successfull!');
                    //return view('roles.index');
                    return redirect()->route('users.index');
                }
            }
        }
        return back();
    }

    public function updatePassword(UpdateUserPWDRequest $request, $id)
    {
        // Validate the data
        // Get the category value from the database
        $user = User::find($id);

        $this->validate($request, array(
            'password' => 'required|min:6|confirmed',
         ));

        // Save the data to the database
        $user->password     = bcrypt($request->password);
        $user->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED user's password (" . $user->id . ")\r\n", 
            [json_decode($user, true)]
        );

        // Set flash data with success message
        Session::flash ('success', 'The user\'s password was successfully updated!');

        // Redirect to posts.show
        return redirect()->route('users.show', $user->id);
    }

    public function activate($id)
    {
        $user = User::find($id);
            $user->active = 1;
        $user->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") ACTIVATED user (" . $user->id . ")\r\n", 
            [json_decode($user, true)]
        );

        Session::flash('success','The user was activated successfully');
        return redirect()->route('users.index');
    }

    public function deactivate($id)
    {
        $user = User::find($id);
            $user->active = 0;
        $user->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DEACTIVATED user (" . $user->id . ")\r\n", 
            [json_decode($user, true)]
        );

        Session::flash('success','The user was de-activated successfully');
        return redirect()->route('users.index');
    }

}