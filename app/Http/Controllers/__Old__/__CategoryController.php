<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Module;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        // Only allow authenticated users access to these functions
        //$this->middleware('auth');

        Log::useFiles(storage_path().'/logs/categories.log');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view ('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $modules = Module::orderBy('name')->get();
        
        $moduls = [];
        // Store the category values into the $cats array
        foreach ($modules as $module) {
            $moduls[$module->id] = $module->name;
        }

        return view('categories.create')->withModules($moduls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new Category;
            $category->name = $request->name;
            $category->module_id = $request->module_id;
        $category->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED category (" . $category->id . ")\r\n", 
            [$category = json_decode($category, true)]
        );

        Session::flash('success','The new category has been created');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find all categories in the categories table and pass them to the view
        $modules = Module::orderBy('name')->get();
        
        $moduls = [];
        // Store the category values into the $cats array
        foreach ($modules as $module) {
            $moduls[$module->id] = $module->name;
        }

        $category = Category::find($id);
        return  view('categories.edit')
            ->withCategory($category)
            ->withModules($moduls);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        // Get the category value from the database
        $category = Category::find($id);
            $category->name = $request->input('name');
            $category->module_id = $request->input('module_id');
        // Save the data to the database
        $category->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED category (" . $category->id . ")\r\n",
            [$category = json_decode($category, true)]
        );

        // Set flash data with success message
        Session::flash ('success', 'The category was successfully updated!');

        // Redirect to posts.show
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        return view('categories.delete', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        $category->delete();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED category (" . $category->id . ")\r\n",
            [$category = json_decode($category, true)]
        );

        Session::flash('success', 'The category was successfully deleted!');
        return redirect()->route('categories.index');
    }
}
