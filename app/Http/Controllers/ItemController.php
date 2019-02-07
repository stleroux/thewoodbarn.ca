<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use App\Http\Controllers\Controller;
use App\Item;
use Auth;
use DB;
use Excel;
// use Gate;
// use Hash;
use Log;
use Session;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{

    // ================================================================================================================================
    // CONSTRUCT ::
    // ================================================================================================================================
    public function __construct() {
        // only allow authenticated users to access these pages
        //$this->middleware('auth', ['except'=>['index','show']]);
        // changing auth to guest would only allow guests to access these pages
        // you can also restrict the actions by adding ['except' => 'name_of_action'] at the end
        $this->middleware('auth');

        Log::useFiles(storage_path().'/logs/items.log');
        Log::useFiles(storage_path().'/logs/audits.log');
    }

    //==================================================================================================================================
    // Display a list of resources
    //==================================================================================================================================
    public function index(Request $request)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        // $items = Item::where('user_id','=', Auth::user()->id)
        $items = Item::with('user')->get();
        return view('items.index',compact('items'));
    }

    //==================================================================================================================================
    // Display a list of soft deleted resources
    //==================================================================================================================================
    public function trashed(Request $request)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }
        
        $items = Item::onlyTrashed()->orderBy('id','DESC')->get();
        return view('items.index',compact('items'));
    }

    //==================================================================================================================================
    // Show the form for creating a new resource
    //==================================================================================================================================
    public function create()
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        return view('items.create');
    }

    //==================================================================================================================================
    // Store a newly created resource in storage
    //==================================================================================================================================
    public function store(CreateItemRequest $request)
    {
        $item = new Item;
            $item->title = $request->title;
            $item->description = $request->description;
            $item->user_id = Auth::user()->id;
        $item->save();

        return redirect()->route('items.index')->with('success','Item created successfully');
    }

    //==================================================================================================================================
    // Display the specified resource
    //==================================================================================================================================
    public function show($id)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        $item = Item::find($id);
        return view('items.show',compact('item'));
    }

    //==================================================================================================================================
    // Show the form for editing the specified resource
    //==================================================================================================================================
    public function edit($id)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        $item = Item::find($id);
        return view('items.edit',compact('item'));
    }

    //==================================================================================================================================
    // Update the specified resource in storage
    //==================================================================================================================================
    public function update(UpdateItemRequest $request, $id)
    {
        Item::find($id)->update($request->all());
        return redirect()->route('items.index')->with('success','Item updated successfully');
    }

    //==================================================================================================================================
    // Remove the specified resource from storage
    //==================================================================================================================================
    public function destroy($id)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        Item::find($id)->delete();
        return redirect()->route('items.index')->with('success','Item trashed successfully');
    }

    //==================================================================================================================================
    // Remove the specified resource from storage
    //==================================================================================================================================
    public function destroyTrashed($id)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        Item::withTrashed()->find($id)->forceDelete();
        return redirect()->route('items.index')->with('success','Item deleted successfully');
    }

    //==================================================================================================================================
    // Mass Delete selected rows
    //==================================================================================================================================
    public function massDestroy(Request $request)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        $items = explode(',', $request->input('ids'));
        foreach ($items as $item_id) {
            $item = Item::findOrFail($item_id);
            $item->delete();
        }
        return redirect()->route('items.index')->with(['message' => 'Items deleted successfully']);
    }

    //==================================================================================================================================
    // Mass Delete selected rows
    //==================================================================================================================================
    public function massDestroyTrashed(Request $request)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        $items = explode(',', $request->input('ids'));
        foreach ($items as $item_id) {
            $item = Item::withTrashed()->findOrFail($item_id);
            $item->forceDelete();
        }
        return redirect()->route('items.index')->with(['message' => 'Items deleted successfully']);
    }

    //==================================================================================================================================
    // Restore the specified resource
    //==================================================================================================================================
    public function restore($id)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        Item::withTrashed()->find($id)->restore();
        return redirect()->route('items.index')->with('success','Item restored successfully');
    }

    //==================================================================================================================================
    // Restore the specified resource
    //==================================================================================================================================
    public function massRestore(Request $request)
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        $items = explode(',', $request->input('ids'));
        //dd($items);
        foreach ($items as $item_id) {
            $item = Item::withTrashed()->findOrFail($item_id);
            $item->restore();
        }

        return redirect()->route('items.index')->with('success','Items restored successfully');
    }

    //==================================================================================================================================
    // 
    //==================================================================================================================================
    public function import()
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        return view('items.import');
    }

    //==================================================================================================================================
    // 
    //==================================================================================================================================
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
    
    //==================================================================================================================================
    // 
    //==================================================================================================================================
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

    //==================================================================================================================================
    // 
    //==================================================================================================================================
    public function importExcel()
    {
        if(!checkACL('manager')) {
            return view('errors.403');
        }

        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
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
                    return redirect()->route('items.index')->with('success','Items imported successfully');;
                }
            }
        }
        return back();
    }

}