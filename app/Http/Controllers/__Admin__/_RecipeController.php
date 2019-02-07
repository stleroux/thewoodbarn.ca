<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Article;
use App\Category;
use App\Item;
use App\Module;
use App\Order;
use App\Permission;
use App\Post;
use App\Product;
use App\Recipe;
use App\Role;
use App\Tag;
Use App\Task;
use App\Tweet;
use App\User;
use Auth;
use DB;
use Excel;
use File;
use Image;
use JavaScript;
use Purifier;
use Session;
use Storage;
use Log;
use Carbon\Carbon;
use Request;

use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;


class RecipeController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/Admin_Recipes.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $recipes = Recipe::with('user','category','modified_by','last_viewed_by')->orderBy('title', 'asc')->get();
    return view('admin.recipes.index', compact('recipes'));
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $recipe = Recipe::find($id);
    
    // Add 1 to views column
    DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

    // If user is logged in, update the last_viewed_by_id and last_viewed_on fields in the recipes table
    if (Auth::check()) {
      DB::statement("UPDATE recipes SET last_viewed_by_id = " . Auth::user()->id . " where id = " . $id );
      DB::statement("UPDATE recipes SET last_viewed_on = " . DB::raw('NOW()') . " where id = " . $id );
    }

    // Save entry to log file using built-in Monolog
    if (Auth::check()) {
      Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED recipe (" . $recipe->id . ")");
    } else {
      Log::info('Guest viewed recipe (' . $recipe->id) . ')';
    }

    return view('admin.recipes.show')->withRecipe($recipe);
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function import()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    return view('admin.recipes.import');
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
          DB::table('recipes')->insert($insert);
          return redirect()->route('admin.recipes.index')->with('success','Recipess imported successfully');;
        }
      }
    }
    return back();
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Recipe::get()->toArray();
    return Excel::create('Recipes_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download($type);
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Recipe::get()->toArray();
    return Excel::create('Recipes_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download("pdf");
  }

 }