<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
Use App\Task;
use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Tasks.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
	public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
		$tasks = Task::with('user')->orderBy('name','ASC')->get();
		return view('admin.tasks.index',compact('tasks'));
	}

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateTaskRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $task = new Task;
      $task->user_id = Auth::user()->id;
      $task->name = $request->name;
    $task->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED task (" . $task->id . ")\r\n", [json_decode($task, true)]);

    Session::flash('success','New task added successfully!');
    return redirect()->route('admin.tasks.index');
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
    
    $task = Task::find($id);
    return view('admin.tasks.edit')->withTask($task);
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateTaskRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // Get the category value from the database
    $task = Task::find($id);
      $task->name = $request->input('name');
    // Save the data to the database
    $task->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED task (" . $task->id . ")\r\n", [json_decode($task, true)]);

    // Set flash data with success message
    Session::flash ('success', 'The task :  ' . $task->name . ' was successfully updated!');
    // Redirect to show page
    return redirect()->route('admin.tasks.index');
  }

    // public function delete($id)
    // {
    //     $task = Task::find($id);
    //     return view('admin.tasks.delete', compact('task'))
    //         // Always lowercase and always plural
    //         ->withSection_name('tasks')
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
    
    $task = Task::find($id);
    $task->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED task (" . $task->id . ")\r\n", [json_decode($task, true)]);

    Session::flash ('success','Task was deleted successfully!');
    return redirect()->route('admin.tasks.index');
  }

  // ================================================================================================================================
  // DUPLICATE :: Duplicate the specified resource in storage.
  // ================================================================================================================================
  public function duplicate($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $task = Task::find($id);
      $newTask = $task->replicate();
    $newTask->save();

    // change the user_id field to be that of the user that is currently logged in
    $newTask->user_id = Auth::user()->id;
    $newTask->save();

    Session::flash ('success','Task was duplicated successfully!');
    return redirect()->route('admin.tasks.index');
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
    
    return view('admin.tasks.import');
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
          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.items.index');
        }
      }
    }
    return back();
  }

}