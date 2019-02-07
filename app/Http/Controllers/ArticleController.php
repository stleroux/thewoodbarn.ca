<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Article;
use App\Category;
use App\User;
use Auth;
use DB;
use Excel;
use Log;
use Session;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{

    //==================================================================================================================================
    // NOTES
    //
    //==================================================================================================================================

    // ================================================================================================================================
    // CONSTRUCT ::
    // ================================================================================================================================
    public function __construct() {
        // only allow authenticated users to access these pages
        //$this->middleware('auth', ['except'=>['index','show']]);
        // changing auth to guest would only allow guests to access these pages
        // you can also restrict the actions by adding ['except' => 'name_of_action'] at the end
        $this->middleware('auth');

        Log::useFiles(storage_path().'/logs/articles.log');
        Log::useFiles(storage_path().'/logs/audits.log');
    }

    //==================================================================================================================================
    // Display a list of resources
    //==================================================================================================================================
    public function index(Request $request)
    {
        if(!checkACL('guest')) {
            return view('errors.403');
        }

        $articles = Article::with('user','category')->orderBy('title','ASC')->get();
        return view('articles.index', compact('articles'));
    }

    //==================================================================================================================================
    // Show the form for creating a new resource
    //==================================================================================================================================
    public function create()
    {
        if(!checkACL('author')) {
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

        return view('articles.create')->withCategories($cats);
    }

    //==================================================================================================================================
    // Store a newly created resource in storage
    //==================================================================================================================================
    public function store(CreateArticleRequest $request)
    {
        if(!checkACL('author')) {
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
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED article (" . $article->id . ")\r\n", [json_decode($article, true)]
        );

        Session::flash('success','The article has been created successfully!');
        // return redirect('articles.index');
        return redirect()->route('articles.index');
    }

    //==================================================================================================================================
    // Display the specified resource
    //==================================================================================================================================
    public function show($id)
    {
        if(!checkACL('guest')) {
            return view('errors.403');
        }

        $article = Article::findOrFail($id);

        // Add 1 to views column
        DB::table('articles')->where('id','=',$article->id)->increment('views',1);

        // Save entry to log file using built-in Monolog
        if (Auth::check()) {
            Log::info(Auth::user()->username . " (" . Auth::user()->id . ") VIEWED article (" . $article->id . ")");
        } else {
            Log::info('Guest viewed article (' . $article->id) . ')';
        }

        return view('articles.show', compact('article'));
    }

    //==================================================================================================================================
    // Show the form for editing the specified resource
    //==================================================================================================================================
    public function edit($id)
    {
        if(!checkACL('author')) {
            return view('errors.403');
        }

        $article = Article::findOrFail($id);

        // find all categories in the categories table and pass them to the view
        $categories = Category::whereHas('module', function ($query) {
            $query->where('name', '=', 'articles');
        })->get();

        // Create an empty array to store the categories
        $cats = [];
        // Store the category values into the $cats array
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        return view('articles.edit', compact('article'))->withCategories($cats);
    }

    //==================================================================================================================================
    // Update the specified resource in storage
    //==================================================================================================================================
    public function update(UpdateArticleRequest $request, $id)
    {
        if(!checkACL('author')) {
            return view('errors.403');
        }

        $article = Article::findOrFail($id);
            $article->title             = $request->title;
            $article->category_id       = $request->category_id;
            $article->description_eng   = $request->description_eng;
            $article->description_fre   = $request->description_fre;
        $article->save();
        
        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED article (" . $article->id . ")\r\n",
            [json_decode($article, true)]
        );

        Session::flash('success','The article has been updated successfully.');
        return redirect()->route('articles.index');
    }

    //==================================================================================================================================
    // Remove the specified resource from storage
    //==================================================================================================================================
    public function destroy($id)
    {
        if(!checkACL('author')) {
            return view('errors.403');
        }

        $article = Article::findOrFail($id);
        $article->delete();

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED article (" . $article->id . ")\r\n",
            [json_decode($article, true)]
        );

        Session::flash('success','The article was deleted successfully.');
        return redirect()->route('articles.index');
    }

// ================================================================================================================================
  // DUPLICATE :: Duplicate the specified resource in storage.
  // ================================================================================================================================
  public function duplicate($id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Articles / Duplicate");
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
    return redirect()->route('articles.index');
  }

  // ================================================================================================================================
  // 
  // ================================================================================================================================
  public function exportPDF()
  {
    if(!checkACL('manager')) {
      return view('errors.403');
    }
    
    $data = Article::get()->toArray();
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
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Articles / Import");
      return view('errors.403');
    }

    // Save entry to log file of failure
    Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Articles / Import");

    return view('articles.import');
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
          return redirect()->route('articles.index');
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
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Articles / Download");
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

    //==================================================================================================================================
    // 
    //==================================================================================================================================
    public function printArticle($id)
    {
        if(!checkACL('author')) {
            return view('errors.403');
        }

        $article = Article::find($id);

        // Save entry to log file using built-in Monolog
        Log::info(Auth::user()->username . " (" . Auth::user()->id . ") PRINTED article (" . $article->id . ")\r\n", 
            [json_decode($article, true)]
        );

        return view('articles.print')->withArticle($article);
    }
}
