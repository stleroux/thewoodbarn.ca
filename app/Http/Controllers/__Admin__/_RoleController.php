<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use DB;
use Log;
use Session;
use Excel;
use Carbon\Carbon;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Roles.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index(Request $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $roles = Role::orderBy('id','desc')->get();
    // $roles = Role::All();
    return view('admin.roles.index', compact('roles'));
    //->with('i', ($request->input('page', 1) - 1) * 20);
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    //$permission = Permission::orderBy('name')->get();
    // $permission = Permission::where('admin','=',0)->orderBy('name')->get();
    // $permissionAdmin = Permission::where('admin','=',1)->orderBy('name')->get();

    return view('admin.roles.create');
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateRoleRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $role = new Role();
      $role->name = $request->input('name');
      $role->display_name = $request->input('display_name');
      $role->description = $request->input('description');
    $role->save();

    // foreach ($request->input('permission') as $key => $value) {
    //   $role->attachPermission($value);
    // }

    Session::flash('success','Role created successfully');
    return redirect()->route('admin.roles.index');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $role = Role::find($id);
    // $permission = Permission::where('admin','=',0)->orderBy('name')->get();
    // $permissionAdmin = Permission::where('admin','=',1)->orderBy('name')->get();
    // $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
    //   ->where("permission_role.role_id",$id)
    //   ->orderBy('name')
    //   ->get();
    // $rolePermissionsAdmin = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
    //   ->where("permission_role.role_id",$id)
    //   ->where('admin','=','1')
    //   ->orderBy('name')
    //   ->get();

    return view('admin.roles.show', compact('role'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $role = Role::find($id);
    //$permission = Permission::get();
    // $permission = Permission::where('admin','=',0)->orderBy('name')->get();
    // $permissionAdmin = Permission::where('admin','=',1)->orderBy('name')->get();

    // $rolePermissions = DB::table("permission_role")
    //   ->where("permission_role.role_id",$id)
    //   ->orderBy('permission_id')
    //   ->lists('permission_role.permission_id','permission_role.permission_id');
      
    // $rolePermissionsAdmin = DB::table("permission_role")
    //   ->where('permission_role.role_id',$id)
    //   ->orderBy('permission_id')
    //   ->lists('permission_role.permission_id','permission_role.permission_id');

    return view('admin.roles.edit', compact('role'));
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateRoleRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $role = Role::find($id);
      $role->name = $request->input('name');
      $role->display_name = $request->input('display_name');
      $role->description = $request->input('description');
    $role->save();

    DB::table("permission_role")->where("permission_role.role_id",$id)->delete();

    // foreach ($request->input('permission') as $key => $value) {
    //   $role->attachPermission($value);
    // }

    // if($request->input('permissionAdmin')) {
    //   foreach ($request->input('permissionAdmin') as $key => $value) {
    //     $role->attachPermission($value);
    //   }
    // }

    return redirect()->route('admin.roles.index')->with('success','Role updated successfully');
  }

    // public function delete($id)
    // {
    //     $role = Role::find($id);
    //     return view('admin.roles.delete', compact('role'))
    //         // Always lowercase and always plural
    //         ->withSection_name('roles')
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
    
    DB::table("roles")->where('id',$id)->delete();
    return redirect()->route('admin.roles.index')->with('success','Role deleted successfully');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Role::get()->toArray();
    return Excel::create('Roles_List', function($excel) use ($data) {
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
    
    return view('admin.roles.import');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Role::get()->toArray();
    return Excel::create('Roles_List', function($excel) use ($data) {
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
            'name' => $value->name,
            'display_name' => $value->display_name,
            'description' => $value->description,
            'created_at' => Carbon::now()
          ];
        }
        
        if(!empty($insert)){
          DB::table('roles')->insert($insert);
          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.roles.index');
        }
      }
    }
    return back();
  }

}