<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Module;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateModuleRequest;
use App\Http\Requests\UpdateModuleRequest;

class ModuleController extends Controller
{
    public function __construct() {

        Log::useFiles(storage_path().'/logs/modules.log');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::orderBy('name')->get();
        return view('modules.index')->withModules($modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateModuleRequest $request)
    {
        $module = new Module;
            $module->name = $request->name;
        $module->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED module (" . $module->id . ")\r\n", 
            [json_decode($module, true)]
        );

        Session::flash('success','The new module has been created');
        return redirect()->route('modules.index');
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
        $module = Module::find($id);
        return  view('modules.edit')->withModule($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModuleRequest $request, $id)
    {
        // Get the category value from the database
        $module = Module::find($id);
            $module->name = $request->input('name');
        $module->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED module (" . $module->id . ")\r\n", 
            [json_decode($module, true)]
        );

        // Set flash data with success message
        Session::flash ('success', 'The module was successfully updated!');

        // Redirect to posts.show
        return redirect()->route('modules.index');
    }

    public function delete($id)
    {
        $module = Module::find($id);
        //dd($module);
        $categories = Category::where('module_id', '=', $id)->get();
        //$categories = Category::all();
        //dd($categories);

        return view('modules.delete')->withModule($module)->withCategories($categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::find($id);

        // $categories = Category::where('module_id', '=', $id);
        // dd($categories);


        $module->delete();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED module (" . $module->id . ")\r\n", 
            [json_decode($module, true)]
        );

        Session::flash('success', 'The module was successfully deleted!');
        return redirect()->route('modules.index');
    }

}
