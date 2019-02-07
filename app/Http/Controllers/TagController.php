<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tag;
use App\Post;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{

	/**
	* Restrict access to authenticated users only
	**/
	public function __construct()
	{
		$this->middleware('auth');

        Log::useFiles(storage_path().'/logs/tags.log');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$tags = Tag::all();
        return view('tags.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $tag = new Tag;
           $tag->name = $request->name;
        $tag->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED tag (" . $tag->id . ")\r\n", 
            [json_decode($tag, true)]
        );

        Session::flash('success', 'New tag ' . $tag->name . ' was successfully created!');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED tag (" . $tag->id . ")\r\n", 
            [json_decode($tag, true)]
        );

        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return  view('tags.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        // Get the category value from the database
        $tag = Tag::find($id);
            $tag->name = $request->input('name');
        $tag->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED tag (" . $tag->id . ")\r\n", 
            [json_decode($tag, true)]
        );

        // Set flash data with success message
        Session::flash ('success', 'The tag :  ' . $tag->name . ' was successfully updated!');

        // Redirect to posts.show
        return redirect()->route('tags.index');
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        return view('tags.delete', compact('tag'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        // remove any references to this tag from the post_tag table
        $tag->posts()->detach();

        $tag->delete();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED tag (" . $tag->id . ")\r\n", 
            [json_decode($tag, true)]
        );

        Session::flash('success', 'The tag :  ' . $tag->name . ' was successfully deleted!');
        return redirect()->route('tags.index');
    }

  // ================================================================================================================================
  // IMPORT :: Show the form for importing entries to storage.
  // ================================================================================================================================
  public function import()
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Tags / Import");
      return view('errors.403');
    }

    // Save entry to log file of failure
    Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Tags / Import");

    return view('tags.import');
  }
}
