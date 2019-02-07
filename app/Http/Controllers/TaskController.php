<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{

    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;


    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        Log::useFiles(storage_path().'/logs/tasks.log');
    }


    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index()
    {
        $tasks = Task::All();
        return view('tasks.index')->withTasks($tasks);
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
    public function store(CreateTaskRequest $request)
    {
        $task = new Task;
            $task->user_id = Auth::user()->id;
            $task->name = $request->name;
        $task->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED task (" . $task->id . ")\r\n", 
            [json_decode($task, true)]
        );

        Session::flash('success','New task added successfully!');
        return redirect()->route('tasks.index');
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
        $task = Task::find($id);
        return view('tasks.edit')->withTask($task);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        // Get the category value from the database
        $task = Task::find($id);
            // Save the data to the database
            $task->name = $request->input('name');
        $task->save();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED task (" . $task->id . ")\r\n", 
            [json_decode($task, true)]
        );

        // Set flash data with success message
        Session::flash ('success', 'The task :  ' . $task->name . ' was successfully updated!');

        // Redirect to show page
        return redirect()->route('tasks.index');
    }

    public function delete($id)
    {
        $task = Task::find($id);
        return view('tasks.delete', compact('task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED task (" . $task->id . ")\r\n", 
            [json_decode($task, true)]
        );

        Session::flash ('success','Task was deleted!');
        return redirect()->route('tasks.index');
    }

    public function duplicate($id)
    {
        $task = Task::find($id);
            $newTask = $task->replicate();
        $newTask->save();

        // change the user_id field to be that of the user that is currently logged in
        $newTask->user_id = Auth::user()->id;
        $newTask->save();

        Session::flash ('success','Task was duplicated successfully!');
        return redirect()->route('tasks.index');
    }

}
