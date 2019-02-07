<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Category;
use App\Module;
use Auth;
use DB;
use Excel;
use File;
use Image;
use JavaScript;
use Purifier;
use Session;
use Storage;
use Log;
use Carbon\Carbon;
use Request;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct()
  {
    // Only allow authenticated users access to these functions
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/audits.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index()
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access the index page");
      return view('errors.403');
    }

    // $categories = Category::orderBy('name')->get();
    $categories = Category::with('module')->get();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Categories / Index");

    return view ('admin.categories.index', compact('categories'));
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $modules = Module::orderBy('name')->get();
      
    $moduls = [];
    // Store the category values into the $cats array
    foreach ($modules as $module) {
      $moduls[$module->id] = $module->name;
    }

    return view('admin.categories.create')->withModules($moduls);
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateCategoryRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $category = new Category;
      $category->name = $request->name;
      $category->module_id = $request->module_id;
    $category->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

    Session::flash('success','The new category has been created');
    return redirect()->route('admin.categories.index');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    // find all categories in the categories table and pass them to the view
    $modules = Module::orderBy('name')->get();
      
    $moduls = [];
    // Store the category values into the $cats array
    foreach ($modules as $module) {
      $moduls[$module->id] = $module->name;
    }

    $category = Category::find($id);
    return  view('admin.categories.edit', compact('category'))->withModules($moduls);
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateCategoryRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    // Get the category value from the database
    $category = Category::find($id);
      $category->name = $request->input('name');
      $category->module_id = $request->input('module_id');
    // Save the data to the database
    $category->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

    // Set flash data with success message
    Session::flash ('success', 'The category was successfully updated!');
    // Redirect to posts.show
    return redirect()->route('admin.categories.index');
  }

    // public function delete($id)
    // {
    //     $category = Category::find($id);

    //     return view('admin.categories.delete', compact('category'))
    //         // Always lowercase and always plural
    //         ->withSection_name('categories')     
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

    $category = Category::find($id);
    $category->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

    Session::flash('success', 'The category was successfully deleted!');
    return redirect()->route('admin.categories.index');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $data = Category::get()->toArray();
    return Excel::create('Categories_List', function($excel) use ($data) {
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

    return view('admin.categories.import');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }

    $data = Category::get()->toArray();
    return Excel::create('Categories_List', function($excel) use ($data) {
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
    if(!checkACL('admin')) {
      return view('errors.403');
    }

    if(Input::hasFile('import_file')){
      $path = Input::file('import_file')->getRealPath();
      $data = Excel::load($path, function($reader) {})->get();
      
      if(!empty($data) && $data->count()){
        foreach ($data as $key => $value) {
          $insert[] = [
            'name'         => $value->name,
            'module_id'    => $value->module_id,
            'created_at'    => $value->created_at,
            'updated_at'    => $value->updated_at,
          ];
        }
        
        if(!empty($insert)){
          DB::table('categories')->insert($insert);
          Session::flash('Success','Import was successfull!');
          //return view('roles.index');
          return redirect()->route('admin.categories.index');
          //->with('success','Items imported successfully');;
        }
      }
    }
    return back();
  }

}
