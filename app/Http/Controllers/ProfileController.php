<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Item;
use App\Order;
use App\Post;
use App\Profile;
use App\Recipe;
use App\Task;
use App\Tweet;
use App\User;
use Auth;
use DB;
use File;
use Image;
use Session;
use Log;
use App\UserProfile;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function __construct() {
        // only allow authenticated users to access these pages
        $this->middleware('auth');
        //not needed as control done through routes file

        Log::useFiles(storage_path().'/logs/profiles.log');
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

        // $landings = \DB::table('landing_pages')->lists('name', 'address');
        $articles = Article::where('user_id', '=', Auth::user()->id)->orderBy('title','asc')->get();
        $recipes = Recipe::where('user_id', '=', Auth::user()->id)->orderBy('title','asc')->get();
        $tasks = Task::where('user_id', '=', Auth::user()->id)->orderBy('name','asc')->get();
        $items = Item::where('user_id', '=', Auth::user()->id)->orderBy('title','asc')->get();
        $tweets = Tweet::where('user_id', '=', Auth::user()->id)->orderBy('title','asc')->get();
        $posts = Post::where('user_id', '=', Auth::user()->id)->orderBy('title','asc')->get();
        //$orders = Order::where('user_id', '=', Auth::user()->id)->get();
        $orders = Auth::user()->orders;
            $orders->transform(function($order, $key) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
        //$profile = Profile::where('user_id', '=', Auth::user()->id);
        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED PROFILE\r\n", 
            [json_decode($user, true)]
        );

        return view('profile.show')
            ->withUser($user)
            ->withArticles($articles)
            ->withRecipes($recipes)
            ->withTasks($tasks)
            ->withItems($items)
            ->withTweets($tweets)
            ->withPosts($posts)
            ->withOrders($orders);
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
        return view('profile.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        // Get the category value from the database
        $user = User::find($id);

            // Save the data to the database
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->style = $request->input('style');
            $user->show_email = $request->input('show_email');
            $user->landingPage = $request->input('landingPage');
            $user->display = $request->input('display');
            $user->authorFormat = $request->input('authorFormat');
            $user->dateFormat = $request->input('dateFormat');
            $user->rowsPerPage = $request->input('rowsPerPage');
            $user->actionButtons = $request->input('actionButtons');
            $user->alertFadeTime = $request->input('alertFadeTime');

            // Check if a new image was submitted
            if ($request->hasFile('image')) {
                //Add new photo
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('/images/profiles/' . $filename);
                Image::make($image)->resize(800, 400)->save($location);
                
                // get name of old image
                $oldImageName = $user->image;
                
                // Update database
                $user->image = $filename;

                // Delete old photo
                //Storage::delete($oldImageName);
                File::delete('images/profiles/' . $oldImageName);
            }

        $user->save();

// $profile = Profile::where('user_id', '=', Auth::user()->id)->get();

//             //$profile = Profile::where('user_id','=',2);
//             //dd($profile);
//                 $profile->style = $request->input('style');
//                 $profile->show_email = $request->input('show_email');
//                 $profile->landingPage = $request->input('landingPage');
//                 $profile->display = $request->input('display');
//                 $profile->authorFormat = $request->input('authorFormat');
//                 $profile->dateFormat = $request->input('dateFormat');
//                 $profile->rowsPerPage = $request->input('rowsPerPage');
//                 $profile->actionButtons = $request->input('actionButtons');
//             dd($profile);
//             $user->profile->save();
//             //$profile->user->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED PROFILE\r\n", [json_decode($user, true)]);


        // Set flash data with success message
        Session::flash ('success', 'The profile was successfully updated!');

        // Redirect to posts.show
        return redirect()->route('profile.show', $user->id);
        
    }

    public function changePassword($id)
    {
        $user = User::find($id);
        return view('profile.changePassword')->withUser($user);
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        // Get the category value from the database
        $user = User::find($id);
            $user->password     = bcrypt($request->password);
        $user->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CHANGED PASSWORD\r\n", 
            [json_decode($user, true)]
        );

        // Set flash data with success message
        Session::flash ('success', 'The user\'s password was successfully updated!');

        // Redirect to posts.show
        return redirect()->route('profile.show', $user->id);
    }

    public function showUser($id)
    {
        $user = User::find($id);

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED user (" . $user->id . ")\r\n", 
            [json_decode($user, true)]
        );

        return view('profile.showUser')->withUser($user);
    }

    public function deleteImage($id)
    {
        // Find the user
        $user = User::find($id);

        // Delete the image from the system
        File::delete('images/profiles/' . $user->image);
        
        // Update database
        $user->image = NULL;
        $user->save();

        // Set flash data with success message
        Session::flash ('success', 'The user\'s image was successfully removed!');

        // Send the user back to the Show page
        //return view('profile.show')->withUser($user);
        return redirect()->route('profile.show', $user->id);
    }
}
