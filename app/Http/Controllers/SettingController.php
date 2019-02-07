<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Setting;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct()
  {
    $this->middleware('auth');
    Log::useFiles(storage_path().'/logs/Admin_Settings.log');

  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
	public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
		$settings = Setting::orderBy('name','ASC')->get();
    return view('admin.settings', compact('settings'));
	}

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateSettingRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $setting = new Setting;
      $setting->name = $request->name;
      $setting->displayName = $request->displayName;
      $setting->value = $request->value;
      $setting->description = $request->description;
    $setting->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED setting (" . $setting->id . ")\r\n", [json_decode($setting, true)]);

    Session::flash('success', 'New setting ' . $setting->name . ' was successfully created!');
    return redirect()->route('settings');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateSettingRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // Get the category value from the database
    $setting = Setting::find($id);
      //$setting->name = $request->name;
      //$setting->name = $request->input('name');
      //$setting->displayName = $request->displayName;
      $setting->displayName = $request->input('displayName');
      //$setting->value = $request->value;
      $setting->value = $request->input('value');
      //$setting->description = $request->description;
      $setting->description = $request->input('description');
    $setting->save();

    // Save entry to log file using built-in Monolog
    // Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED setting (" . $setting->id . ")\r\n", 
    //     [json_decode($setting, true)]
    // );

    // Set flash data with success message
    Session::flash ('success', 'The setting:  ' . $setting->name . ' has been successfully updated!');

    // Redirect to posts.show
    return redirect()->route('settings');
  }

    // public function delete($id)
    // {
    //     $setting = Setting::find($id);
    //     return view('settings.delete', compact('setting'));
    // }

  // ================================================================================================================================
  // DELETE :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function destroy($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $setting = Setting::find($id);
    //dd($setting);

    $setting->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED setting (" . $setting->id . ")\r\n", [json_decode($setting, true)]);

    Session::flash('success', 'The setting :  ' . $setting->name . ' was successfully deleted!');
    return redirect()->route('settings');
  }
 
}