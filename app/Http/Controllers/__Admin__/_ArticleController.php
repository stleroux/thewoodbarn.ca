<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Category;
use Auth;
use DB;
use Excel;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');

    Log::useFiles(storage_path().'/logs/audits.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index()
  {

    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Index");
      return view('errors.403');
    }

    // Find all articles and oder them by title in ascending order
    $articles = Article::with('user', 'category')->get();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Articles / Index");

    return view('admin.articles.index', compact('articles'));
  }

  // ================================================================================================================================
  // CREATE :: Show the form for creating a new resource.
  // ================================================================================================================================
  public function create()
  {

    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Create");
      return view('errors.403');
    }

    // find all categories in the categories table and pass them to the view
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'articles');
    })->orderBy('name','asc')->get();

    // Create an empty array to store the categories
    $cats = [];

    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    // Save entry to log file using built-in Monolog
    // actionLog('create','articles');
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Articles / Create");

    return view('admin.articles.create')->withCategories($cats);
  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateArticleRequest $request)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Store");
      return view('errors.403');
    }

    $article = new Article;
      $article->title             = $request->title;
      $article->category_id       = $request->category_id;
      $article->description_eng   = $request->description_eng;
      $article->description_fre   = $request->description_fre;
      $article->user_id           = Auth::user()->id;
    $article->save();

    // Save entry to log file using built-in Monolog
    // actionLog('store', $article);
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") saved :: article " . $article->id);

    Session::flash('success','The article has been created successfully!');
    return redirect()->route('admin.articles.index');
  }

  // ================================================================================================================================
  // SHOW :: Display the specified resource.
  // ================================================================================================================================
  public function show($id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Show");
      return view('errors.403');
    }

    // Find the article by id
    $article = Article::findOrFail($id);

    // Add 1 to views column
    DB::table('articles')->where('id','=',$article->id)->increment('views',1);

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: article " . $article->id);

    // Display the show page
    return view('admin.articles.show', compact('article'));
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Edit");
      return view('errors.403');
    }

    // Find the article by id
    $article = Article::findOrFail($id);

    // Find all categories in the categories table and pass them to the view
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'articles');
    })->get();

    // Create an empty array to store the categories
    $cats = [];

    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") edited :: article " . $article->id);

    // Display the edit page
    return view('admin.articles.edit', compact('article'))->withCategories($cats);
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateArticleRequest $request, $id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Update");
      return view('errors.403');
    }

    $article = Article::findOrFail($id);
      $article->title             = $request->title;
      $article->category_id       = $request->category_id;
      $article->description_eng   = $request->description_eng;
      $article->description_fre   = $request->description_fre;
    $article->save();
    
    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") updated :: article " . $article->id);

    Session::flash('success','The article has been updated successfully.');
    return redirect()->route('admin.articles.index');
  }

  // ================================================================================================================================
  // DELETE :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function destroy($id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Delete");
      return view('errors.403');
    }

    $article = Article::findOrFail($id);
    $article->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") deleted :: article " . $article->id);

    Session::flash('success','The article has been deleted successfully.');
    return redirect()->route('admin.articles.index');
  }

  public function deleteSelected()
  {
    $articles = Article::destroy(Request::get('ids_to_delete'));
    dd($articles);
  }
  


  // ================================================================================================================================
  // DUPLICATE :: Duplicate the specified resource in storage.
  // ================================================================================================================================
  public function duplicate($id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Duplicate");
      return view('errors.403');
    }

    $article = Article::find($id);
      $newArticle = $article->replicate();
    $newArticle->save();

    // change the user_id field to be that of the user that is currently logged in
    $newArticle->user_id = Auth::user()->id;
    $newArticle->views = 0;
    $newArticle->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") duplicated :: article " . $article->id . " to article ". $newArticle->id);

    Session::flash ('success','Article was duplicated successfully!');
    return redirect()->route('admin.articles.index');
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
    return Excel::create('Articles_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download("pdf");
  }

  // ================================================================================================================================
  // IMPORT :: Show the form for importing entries to storage.
  // ================================================================================================================================
  public function import()
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Import");
      return view('errors.403');
    }

    // Save entry to log file of failure
    Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Articles / Import");

    return view('admin.articles.import');
  }

  // ================================================================================================================================
  // IMPORT FUNCTION
  // ================================================================================================================================
  public function importExcel()
  {
    // if(!checkACL('manager')) {
    //   // Save entry to log file of failure
    //   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Import");
    //   return view('errors.403');
    // }

    if(Input::hasFile('import_file')){
      $path = Input::file('import_file')->getRealPath();
      $data = Excel::load($path, function($reader) {
      })->get();
      if(!empty($data) && $data->count()){
        foreach ($data as $key => $value) {
          $insert[] = [
            'title'         => $value->title,
            'category_id'   => $value->category_id,
            'description_eng'=> $value->description_eng,
            'description_fre'=> $value->description_fre,
            'user_id'       => $value->user_id,
            'created_at'    => $value->created_at,
            'updated_at'    => $value->updated_at,
          ];
        }
        if(!empty($insert)){
          DB::table('articles')->insert($insert);

          // Save entry to log file of failure
          //Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") imported :: articles");

          Session::flash('Success','Import was successfull!');
          return redirect()->route('admin.articles.index');
        }
      }
    }
    return back();
  }

  // ================================================================================================================================
  // DOWNLOAD TO EXCEL
  // ================================================================================================================================
  public function downloadExcel($type)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Download");
      return view('errors.403');
    }

    $data = Article::get()->toArray();

    // Save entry to log file of failure
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") downloaded :: articles");

    return Excel::create('Articles_List', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download($type);
  }



 }