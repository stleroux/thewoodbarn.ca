<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Post;
use App\Tag;
use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT :: 
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');
    
    Log::useFiles(storage_path().'/logs/Admin_Posts.log');
  }
    
  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    //create a variable and store all posts in it
    // $posts = Post::all(); // Pulls all records from the database
    // $posts = Post::orderBy('id', 'desc')->get();
    $posts = Post::with('user', 'comments')->orderBy('id', 'desc')->get();

    // return a view and pass in the above variable
    return view ('admin.posts.index', compact('posts'));
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // find all categories in the categories table and pass them to the view
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', 'like', 'posts');
    })->get();

    // Create an empty array to store the categories
    $cats = [];
    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    $tags = Tag::all();

    return view ('admin.posts.create')->withCategories($cats)->withTags($tags);
  }


  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreatePostRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // save the data in the database
    $post = new Post;

      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->category_id = $request->category_id;
      // $post->body = $request->body;
      $post->body = Purifier::clean($request->body);
      $post->user_id = Auth::user()->id;
      $post->modified_by_id = Auth::user()->id;

      // Save the image if there is one
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/posts/' . $filename);
        Image::make($image)->resize(800, 400)->save($location);
        $post->image_path = $filename;
      }

    $post->save();

    // save the tags in the post_tag table
    // false required as default (otherwise override existing association)
    //$post->tags()->sync($request->tags, false);
    if (isset($request->tags))
    {
      $post->tags()->sync($request->tags, false);
    } else {
      $post->tags()->sync(array());
    }

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED post (" . $post->id . ")\r\n", [json_decode($post, true)]);

    // set a flash message to be displayed on screen
    Session::flash('success','The post was successfully saved!');
    // redirect to another page
    return redirect()->route('admin.posts.show', $post->id);
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $post = Post::find($id);
        
    // find the categories
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'posts');
    })->get();

    // Create an empty array to store the categories
    $cats = [];
    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    // find the associated tags
    $tags = Tag::all();
    // Create an empty array to store the tags
    $tags2 = [];
      foreach ($tags as $tag) {
        $tags2[$tag->id] = $tag->name;
      }

    // Add 1 to views column
    DB::table('posts')->where('id','=',$post->id)->increment('views',1);

    return view ('admin.posts.show', compact('post','cats','tags2'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // find the post in the db and save it to a variable
    $post = Post::find($id);
      
    // find the categories //$categories = Category::where('module','=','posts')->get();
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'posts');
    })->get();

    // Create an empty array to store the categories
    $cats = [];
    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    // find the associated tags
    $tags = Tag::all();
    // Create an empty array to store the tags
    $tags2 = [];
      foreach ($tags as $tag) {
        $tags2[$tag->id] = $tag->name;
      }

    // return the view and pass in the variable $post
    // also pass in the $cats variable
    return view ('admin.posts.edit', compact('post'))->withCategories($cats)->withTags($tags2);
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdatePostRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // Get the post values from the database
    $post = Post::find($id);

      // Save the data to the database
      $post->title = $request->input('title');
      $post->slug = $request->input('slug');
      $post->category_id = $request->input('category_id');
      //$post->body = $request->input('body');
      $post->body = Purifier::clean($request->input('body'));
      $post->modified_by_id = Auth::user()->id;

      // Check if a new image was submitted
      if ($request->hasFile('image')) {
        //Add new photo
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/posts/' . $filename);
        Image::make($image)->resize(800, 400)->save($location);
        // get name of old image
        $oldImageName = $post->image_path;
        // Update database
        $post->image_path = $filename;
        // Delete old photo
        File::delete('images/posts/' . $oldImageName);
      }

    $post->save();

    //save the tags in the databse
    // not adding 2nd param will delete all entries in array and replace them with new ones
    // check that there is something in the array and then save it else pass an empty array
    if (isset($request->tags))
    {
      $post->tags()->sync($request->tags);
    } else {
      $post->tags()->sync(array());
    }

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED post (" . $post->id . ")\r\n", [json_decode($post, true)]);

    // Set flash data with success message
    Session::flash ('success', 'This post was successfully updated!');
    // Redirect to posts.show
    return redirect()->route('admin.posts.index');
  }

    // public function delete($id)
    // {
    //     $post = Post::find($id);

    //     return view('admin.posts.delete')
    //         ->withPost($post)
    //         // Always lowercase and always plural
    //         ->withSection_name('posts')
    //         // Name of the action being performed
    //         ->withAction_name('delete');
    // }

  // ================================================================================================================================
  // DELETE :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function destroy($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $post = Post::find($id);
    
    // remove any references to this post from the post_tag table
    $post->tags()->detach();

    // Delete the associated image if any
    //Storage::delete($post->image_path);
    $post->delete();
    File::delete('images/posts/' . $post->image_path);

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED post (" . $post->id . ")\r\n", [json_decode($post, true)]);

    Session::flash('success', 'The post was successfully deleted!');
    return redirect()->route('admin.posts.index');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function viewImage($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $post = Post::find($id);
    return view('admin.posts.viewImage', compact('post'));
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function delete_image($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // Find the user
    $post = Post::find($id);

    // Delete the image from the system
    File::delete('images/posts/' . $post->image_path);
    
    // Update database
    $post->image_path = NULL;
    $post->save();
    
    // Set flash data with success message
    Session::flash ('success', 'The post\'s image was successfully removed!');
    return view ('admin.posts.show', compact('post'));
  }

  //==================================================================================================================================
  // PRINT POST
  //==================================================================================================================================
  public function printPost($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $post = Post::find($id);

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") PRINTED post (" . $post->id . ")\r\n", [json_decode($post, true)]);

    return view('admin.post.print')->withPost($post);
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function showUser($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $user = User::find($id);
    return view('posts.showUser', compact('user'));
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
	public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Post::get()->toArray();
    return Excel::create('Posts_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download("pdf");
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function import()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
  
    return view('admin.posts.import');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
  
    $data = Post::get()->toArray();
    return Excel::create('Posts_List', function($excel) use ($data) {
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
            'title'         => $value->title,
            'body'          => $value->body,
            'slug'          => $value->slug,
            'image_path'    => $value->image_path,
            'views'         => $value->views,
            'category_id'   => $value->category_id,
            'user_id'       => $value->user_id,
            'modified_by_id'=> $value->modified_by_id,
            'created_at'    => $value->created_at,
            'updated_at'    => $value->updated_at,
          ];
        }

        if(!empty($insert)){
          DB::table('posts')->insert($insert);
          //dd('Insert Record successfully.');
          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.posts.index');
        }
      }
    }
    return back();
  }

 }