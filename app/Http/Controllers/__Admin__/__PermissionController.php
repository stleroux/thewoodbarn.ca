<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permission;
use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
	public function index()
  {
    $permissions = Permission::orderBy('name','ASC')->get();
    return view('admin.permissions.index', compact('permissions'));
	}


  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    $permission = Permission::get();
    return view('admin.permissions.create', compact('permission'));
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreatePermissionRequest $request)
  {
    $permission = new Permission();
      $permission->name = $request->input('name');
      $permission->display_name = $request->input('display_name');
      $permission->admin = $request->input('admin');
      $permission->description = $request->input('description');
    $permission->save();

    return redirect()->route('admin.permissions.index')->with('success','Permission created successfully');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    $permission = Permission::find($id);
    return view('admin.permissions.show', compact('permission'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    $permission = Permission::find($id);
    return view('admin.permissions.edit', compact('permission'));
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdatePermissionRequest $request, $id)
  {
    $permission = Permission::find($id);
      $permission->name = $request->input('name');
      $permission->display_name = $request->input('display_name');
      $permission->admin = $request->input('admin');
      $permission->description = $request->input('description');
    $permission->save();

    return redirect()->route('admin.permissions.index')->with('success','Permission updated successfully');
  }

    // public function delete($id)
    // {
    //     $permission = Permission::find($id);
    //     return view('admin.permissions.delete', compact('permission'))
    //         // Always lowercase and always plural
    //         ->withSection_name('permissions')
    //         // Name of the action being performed
    //         ->withAction_name('delete');
    // }

  // ================================================================================================================================
  // DELETE :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function destroy($id)
  {
    if (is_array($id)) 
    {
      Permissions::destroy($id);
    }
    else
    {
      DB::table("permissions")->where('id',$id)->delete();
    }

    return redirect()->route('admin.permissions.index')->with('success','Permission deleted successfully');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
	public function exportPDF()
    {
       $data = Permission::get()->toArray();
       return Excel::create('Permissions_List', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
            $sheet->fromArray($data);
        });
       })->download("pdf");
    }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
    public function duplicate($id)
    {
        $permission = Permission::find($id);
            $newPermission = $permission->replicate();
        //$newPermission->save();

        $newPermission->name = $permission->name.'__';
        $newPermission->save();

        Session::flash ('success','Permission was duplicated successfully!');
        return redirect()->route('admin.permissions.index');
    }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
    public function makeAdmin($id)
    {
        $permission = Permission::find($id);
            //$newPermission = $permission->replicate();
        //$newPermission->save();

        $permission->name = $permission->name.'_admin';
        $permission->admin = 1;
        $permission->save();

        Session::flash ('success','Permission converted to admin successfully!');
        return redirect()->route('admin.permissions.index');
    }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
    public function import()
    {
        return view('admin.permissions.import');
            // Always lowercase and always plural
            //->withSection_name('permissions')
            // Name of the action being performed
            //->withAction_name('import');
    }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
    public function downloadExcel($type)
    {
        $data = Permission::get()->toArray();
        return Excel::create('Permissions_List', function($excel) use ($data) {
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
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'name'          => $value->name,
                        'display_name'  => $value->display_name,
                        'description'   => $value->description,
                        'created_at'    => $value->created_at,
                        'updated_at'    => $value->updated_at,
                        ];
                }
                if(!empty($insert)){
                    DB::table('permissions')->insert($insert);
                    Session::flash('Success','Import was successfull!');
                    return redirect()->route('admin.permissions.index');
                }
            }
        }
        return back();
    }

 }