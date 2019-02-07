<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tweet;
use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;
use Carbon\Carbon;


use App\Http\Requests\CreateTweetRequest;
use App\Http\Requests\UpdateTweetRequest;

class TweetController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Tweets.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tweets = Tweet::orderBy('title','ASC')->get();
    return view('admin.tweets.index',compact('tweets'));
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    return view('admin.tweets.create');
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateTweetRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tweet = new Tweet();
      $tweet->title = $request->input("title");
      $tweet->body = $request->input("body");
      $tweet->user_id = Auth::user()->id;
    $tweet->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED tweet (" . $tweet->id . ")\r\n", [$tweet = json_decode($tweet, true)]);

    // set a flash message to be displayed on screen
    Session::flash('success','The tweet was successfully added!');
    return redirect()->route('admin.tweets.index');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tweet = Tweet::findOrFail($id);

    // Save entry to log file using built-in Monolog
    if (Auth::check()) {
      Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED tweet (" . $tweet->id . ")");
    } else {
      Log::info('Guest viewed tweet id ' . $tweet->id);
    }

    return view('admin.tweets.show', compact('tweet'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tweet = Tweet::findOrFail($id);
    return view('admin.tweets.edit', compact('tweet'));
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateTweetRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $tweet = Tweet::findOrFail($id);
      $tweet->title = $request->input("title");
      $tweet->body = $request->input("body");
    $tweet->save();
      
    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . "( " . Auth::user()->id . ") UPDATED tweet (" . $tweet->id . ")\r\n", [$tweet = json_decode($tweet, true)]);

    // set a flash message to be displayed on screen
    Session::flash('info','The tweet was successfully updated!');

    return redirect()->route('admin.tweets.index');
  }

    // public function delete($id)
    // {
    //     $tweet = Tweet::find($id);
    //     return view('admin.tweets.delete', compact('tweet'))
    //         // Always lowercase and always plural
    //         ->withSection_name('tweets')
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
    
    $tweet = Tweet::findOrFail($id);
    $tweet->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . "( " . Auth::user()->id . ") DELETED tweet (" . $tweet->id . ")\r\n", [$tweet = json_decode($tweet, true)]);

    // set a flash message to be displayed on screen
    Session::flash('danger','The tweet was successfully deleted!');
    return redirect()->route('admin.tweets.index');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
	public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Tweet::get()->toArray();
    return Excel::create('Items_List', function($excel) use ($data) {
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
    
    return view('admin.tweets.import');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Tweet::get()->toArray();
    return Excel::create('Tweets_List', function($excel) use ($data) {
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
            'user_id'       => $value->user_id,
            'created_at'    => Carbon::now()
          ];
        }
        
        if(!empty($insert)){
          DB::table('tweets')->insert($insert);
          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.tweets.index');
        }
      }
    }
    return back();
  }

}