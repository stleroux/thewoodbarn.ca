<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
//use App\Profile;
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

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Users.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index(Request $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $users = User::with('role')->orderBy('username','ASC')->get();
    // $users = User::with('role')->get();
    return view('admin.users.index',compact('users'));
    // return view('admin.users.index')->withUsers($users);
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $roles = Role::pluck('display_name','id');
    return view('admin.users.create',compact('roles'));
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateUserRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $input = $request->all();
    $input['password'] = Hash::make($input['password']);

    $user = User::create($input);
      // foreach ($request->input('roles') as $key => $value) {
      //   $user->attachRole($value);
      // }

    Session::flash('success','User created successfully');
    return redirect()->route('admin.users.index');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);
    // $roles = Role::pluck('display_name','id');
    // $userRole = $user->roles->pluck('id','id')->toArray();
      
    return view('admin.users.show',compact('user'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);
    // $roles = Role::pluck('display_name','id');
    $rols = Role::All();
    // $userRole = $user->roles->pluck('id','id')->toArray();

    // Create an empty array to store the roles
    $roles = [];
    // Store the role values into the $roles array
    foreach ($rols as $rol) {
      $roles[$rol->id] = $rol->name;
    }

    // return view('admin.users.edit',compact('user','roles','userRole'));
    return view('admin.users.edit',compact('user', 'roles'));
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateUserRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $input = $request->all();
      
    if(!empty($input['password'])){ 
      $input['password'] = Hash::make($input['password']);
    }else{
      $input = array_except($input,array('password'));    
    }

    $user = User::find($id);

    $user->update($input);

    DB::table('role_user')->where('user_id',$id)->delete();
    
    //foreach ($request->input('roles') as $key => $value) {
    //  $user->attachRole($value);
    //}

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED user (" . $user->id . ")\r\n", [json_decode($user, true)]);

    Session::flash('success','User updated successfully');
    return redirect()->route('admin.users.index');
  }

  // ================================================================================================================================
  // DELETE :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function delete($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);
    return view('admin.users.delete', compact('user'));
  }
    
  // ================================================================================================================================
  // DELETE :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function destroy($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);

    //         // Delete the profile image if any
    //         File::delete('images/profiles/' . $user->image);
            
    //         //Delete favorites that this user added to the system
    //         DB::table('recipe_user')->where('user_id', '=', $user->id)->delete();
            
    //         // Delete favorites from other users to this user's recipes
    //         $recipes = Recipe::where('user_id', '=', $user->id)->get();
    //             foreach ($recipes as $recipe) {
    //                 DB::table('recipe_user')->where('recipe_id', '=', $recipe->id)->delete();
    //             }
            
    //         //Delete recipes created by this user
    //         DB::table('recipes')->where('user_id', '=', $user->id)->delete();

    //         //Delete the user's roles (if any)
    //         DB::table('role_user')->where('user_id', '=', $user->id)->delete();

    //         //Delete posts created by this user
    //         DB::table('posts')->where('user_id', '=', $user->id)->delete();
    //         // Comments associated to this post will be automatically deleted from the DB using a foreign key constraint

    // //also need to delete post_tag, post_images, tasks

    // Delete the user
    $user->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED user (" . $user->id . ")\r\n", [json_decode($user, true)]);

    Session::flash('success', 'The user was successfully deleted!');
    return redirect()->route('admin.users.index');
  }

  // ================================================================================================================================
  // EXPORT TO PDF
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = User::get()->toArray();
    return Excel::create('Users_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download("pdf");
  }

  // ================================================================================================================================
  // IMPORT
  // ================================================================================================================================
  public function import()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    return view('admin.includes.import');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = User::get()->toArray();
    return Excel::create('Users_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download($type);
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function importExcel()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    if(Input::hasFile('import_file')){
      $path = Input::file('import_file')->getRealPath();
      $data = Excel::load($path, function($reader) {})->get();
      
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
          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.users.index');
        }
      }
    }
    return back();
  }

  // ================================================================================================================================
  // UPDATE USER PASSWORD
  // ================================================================================================================================
  // might not be needed here. should go in front end controller
  public function updatePassword(UpdateUserPWDRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
      
    // Get the user from the database
    $user = User::find($id);

    // Validate the data
    $this->validate($request, array(
      'password' => 'required|min:6|confirmed',
    ));

    // Save the data to the database
    $user->password     = bcrypt($request->password);
    $user->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED user's password (" . $user->id . ")\r\n", [json_decode($user, true)]);

    // Set flash data with success message
    Session::flash ('success', 'The user\'s password was successfully updated!');
    // Redirect to posts.show
    return redirect()->route('users.show', $user->id);
  }

  // ================================================================================================================================
  // ACTIVATE ACCOUNT
  // ================================================================================================================================
  public function activate($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);
      $user->active = 1;
    $user->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") ACTIVATED user (" . $user->id . ")\r\n", [json_decode($user, true)]);

    Session::flash('success','The user was activated successfully');
    return redirect()->route('admin.users.index');
  }

  // ================================================================================================================================
  // DEACTIVATE ACCOUNT
  // ================================================================================================================================
  public function deactivate($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);
      $user->active = 0;
    $user->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DEACTIVATED user (" . $user->id . ")\r\n", [json_decode($user, true)]);

    Session::flash('success','The user was de-activated successfully');
    return redirect()->route('admin.users.index');
  }

}