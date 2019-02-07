<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tag;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Tags.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tags = Tag::all();
    return view('admin.tags.index')->withTags($tags);
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateTagRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tag = new Tag;
      $tag->name = $request->name;
    $tag->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED tag (" . $tag->id . ")\r\n", [json_decode($tag, true)]);

    Session::flash('success', 'New tag ' . $tag->name . ' was successfully created!');
    return redirect()->route('admin.tags.index');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tag = Tag::find($id);

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED tag (" . $tag->id . ")\r\n", [json_decode($tag, true)]);

    return view('admin.tags.show')->withTag($tag);
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tag = Tag::find($id);
    return view('admin.tags.edit')->withTag($tag);
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateTagRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // Get the category value from the database
    $tag = Tag::find($id);
      $tag->name = $request->input('name');
    $tag->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED tag (" . $tag->id . ")\r\n", [json_decode($tag, true)]);

    // Set flash data with success message
    Session::flash ('success', 'The tag :  ' . $tag->name . ' was successfully updated!');
    // Redirect to posts.show
    return redirect()->route('admin.tags.index');
  }

    // public function delete($id)
    // {
    //     $tag = Tag::find($id);
    //     return view('admin.tags.delete', compact('tag'))
    //         // Always lowercase and always plural
    //         ->withSection_name('tags')
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
    
    $tag = Tag::find($id);

    // remove any references to this tag from the post_tag table
    $tag->posts()->detach();
    $tag->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED tag (" . $tag->id . ")\r\n", [json_decode($tag, true)]);

    Session::flash('success', 'The tag :  ' . $tag->name . ' was successfully deleted!');
    return redirect()->route('admin.tags.index');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Item::get()->toArray();
    return Excel::create('Tags_List', function($excel) use ($data) {
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
    
      return view('admin.tags.import');
    }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Item::get()->toArray();
    return Excel::create('Tags_List', function($excel) use ($data) {
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
            'name'         => $value->name,
            'name'         => $value->name,     
            'created_at'    => $value->created_at,
            'updated_at'    => $value->updated_at,
          ];
        }
              
        if(!empty($insert)){
          DB::table('tags')->insert($insert);
          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.tags.index');
        }
      }
    }
    return back();
  }
}
