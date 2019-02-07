<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;
use DB;
use Excel;
use Hash;
use Session;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('title','ASC')->get();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        //Item::create($request->all());
        $product = new Product;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->user_id = Auth::user()->id;
        $product->save();

        return redirect()->route('products.index')
                         ->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        Product::find($id)->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return view('products.delete', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }


    public function exportPDF()
    {
       $data = Product::get()->toArray();
       return Excel::create('Products_List', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
            $sheet->fromArray($data);
        });
       })->download("pdf");
    }

    public function import()
    {
        return view('products.import');
    }

    public function downloadExcel($type)
    {
        $data = Product::get()->toArray();
        return Excel::create('Products_List', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
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
                    //dd('Insert Record successfully.');
                    //Session::flash('Success','Import was successfull!');
                    //return view('roles.index');
                    return redirect()->route('products.index')
                        ->with('success','Products imported successfully');;
                }
            }
        }
        return back();
    }
}
