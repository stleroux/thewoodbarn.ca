<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Item;
use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Items.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
	public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

		// $items = Item::orderBy('title','ASC')->get();
    // $items = Item::All();
    $items = Item::with('user')->get(); // Eager loading of users so that query count remains low

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") ACCESSED the index page");

		return view('admin.items.index',compact('items'));
	}

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    return view('admin.items.create');
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateItemRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    //Item::create($request->all());
    $item = new Item;
      $item->title = $request->title;
      $item->description = $request->description;
      $item->user_id = Auth::user()->id;
    $item->save();

    return redirect()->route('admin.items.index')->with('success','Item created successfully');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $item = Item::find($id);
    return view('admin.items.show',compact('item'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $item = Item::find($id);
    return view('admin.items.edit',compact('item'));
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateItemRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    Item::find($id)->update($request->all());
    return redirect()->route('admin.items.index')->with('success','Item updated successfully');
  }

    // public function delete($id)
    // {
    //     $item = Item::find($id);
    //     return view('admin.items.delete', compact('item'))
    //         // Always lowercase and always plural
    //         ->withSection_name('items')
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

    Item::find($id)->delete();
    return redirect()->route('admin.items.index')->with('success','Item deleted successfully');
  }

  // ================================================================================================================================
  // DUPLICATE :: Duplicate the specified resource in storage.
  // ================================================================================================================================
  public function duplicate($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $item = Item::find($id);
      $newItem = $item->replicate();
    $newItem->save();

    // change the user_id field to be that of the user that is currently logged in
    $newItem->user_id = Auth::user()->id;
    $newItem->save();

    Session::flash ('default','Item was duplicated successfully!');
    return redirect()->route('admin.items.index');
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

    return view('admin.items.import');
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
    return Excel::create('Items_List', function($excel) use ($data) {
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
            'description'   => $value->description,
            'user_id'       => $value->user_id,
            'created_at'    => $value->created_at,
            'updated_at'    => $value->updated_at,
          ];
        }
        
        if(!empty($insert)){
          DB::table('items')->insert($insert);
          //dd('Insert Record successfully.');
          Session::flash('Success','Import was successfull!');
          //return view('roles.index');
          return redirect()->route('admin.items.index');
          //->with('success','Items imported successfully');;
        }
      }
    }
    return back();
  }

 }