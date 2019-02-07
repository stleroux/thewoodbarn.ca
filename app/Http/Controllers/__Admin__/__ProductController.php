<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Auth;
use DB;
use Excel;
use Hash;
use Log;
use Session;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Products.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index(Request $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $products = Product::with('user','category')->orderBy('title','ASC')->get();
    return view('admin.products.index', compact('products'));
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    // find all categories in the categories table and pass them to the view
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'products');
    })->orderBy('name','asc')->get();

    // Create an empty array to store the categories
    $cats = [];

    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }
      
    return view('admin.products.create')->withCategories($cats);
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateProductRequest $request)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $product = new Product;
      $product->title = $request->title;
      $product->category_id = $request->category_id;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->user_id = Auth::user()->id;
    $product->save();

    return redirect()->route('admin.products.index')->with('success','Product created successfully');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $product = Product::find($id);
    return view('admin.products.show', compact('product'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $product = Product::findOrFail($id);

    // find all categories in the categories table and pass them to the view
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'products');
    })->get();

    // Create an empty array to store the categories
    $cats = [];
    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    return view('admin.products.edit', compact('product'))->withCategories($cats);
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateProductRequest $request, $id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    Product::find($id)->update($request->all());
    return redirect()->route('admin.products.index')->with('success','Product updated successfully');
  }

    // public function delete($id)
    // {
    //     $product = Product::find($id);
    //     return view('admin.products.delete', compact('product'))
    //         // Always lowercase and always plural
    //         ->withSection_name('products')
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
    
    Product::find($id)->delete();
    return redirect()->route('admin.products.index')->with('success','Product deleted successfully');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Product::get()->toArray();
    return Excel::create('Products_List', function($excel) use ($data) {
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
    
    return view('admin.products.import');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Product::get()->toArray();
    return Excel::create('Products_List', function($excel) use ($data) {
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
            'price'         => $value->price,
            'category_id'   => $value->category_id,
            'imagePath'     => $value->imagePath,
            'user_id'       => $value->user_id,
            'created_at'    => $value->created_at,
            'updated_at'    => $value->updated_at,
          ];
        }
        
        if(!empty($insert)){
          DB::table('products')->insert($insert);
          return redirect()->route('admin.products.index')->with('success','Products imported successfully');;
        }
      }
    }
    return back();
  }

}
