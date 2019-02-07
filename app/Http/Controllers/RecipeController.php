<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Category;
use App\Recipe;
use App\User;
use App\Module;
use Auth;
use DB;
use File;
use Image;
use JavaScript;
use Purifier;
use Session;
use Storage;
use Log;
use Carbon\Carbon;

use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth', ['except'=>['index','show','viewImage','showUser','archive']]);
    Log::useFiles(storage_path().'/logs/audits.log');
  }

  // ================================================================================================================================
  // INDEX :: Display a listing of the resource.
  // ================================================================================================================================
  public function index($key)
  {
    // Save entry to log file using built-in Monolog
    if (Auth::check()) {
      Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Recipes / Index");
    } else {
      Log::info( getClientIP() . " accessed :: Recipes / index");
    }

    //$alphas = range('A', 'Z');
      $alphas = DB::table('recipes')
        ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
        ->where('personal', '!=', 1)
        ->where('published','=', 1)
        ->orderBy('letter')
        ->get();
      //dd($alphas);

      $letters = [];
        foreach($alphas as $alpha) {
          $letters[] = $alpha->letter;
        }
      //dd($letters);

      if(checkACL('publisher')) {
        $pub = 0;
        //dd($pub);
      } else {
        $pub = 1;
      }

      if ($key == 'all') {
        // Display all the user's recipes plus the one from other users that are not marked as personal/private
        $recipes = Recipe::with('user','category')
          ->where('personal','!=',1)
          ->where('published','>=', $pub)
          ->orderBy('title', 'asc')
          ->get();
        return view('recipes.index', compact('recipes','letters'));
      }
      
      if ($key != 'all') {
        $recipes = Recipe::with('user','category')
          ->where('personal', '!=', 1)
          ->where('published','>=', $pub)
          ->where('title', 'like', $key . '%')
          ->orderBy('title', 'asc')
          ->get();
        return view('recipes.index', compact('recipes','letters'));
      }
    // } else {
    //   if ($key == 'all') {
    //     // Display all the user's recipes that are not marked as personal/private
    //     $recipes = Recipe::where('personal','!=',1)->orderBy('title', 'asc')->get();
    //     return view('recipes.index')->withRecipes($recipes);
    //   }
      
    //   if ($key != 'all') {
    //     $recipes = Recipe::where('personal', '!=', 1)->where('title', 'like', $key . '%')->get();
    //     return view('recipes.index')->withRecipes($recipes);
    //   }
    // }
  }

  //==================================================================================================================================
  // CREATE :: Show the form for creating a new resource
  //==================================================================================================================================
  public function create()
  {
    if(!checkACL('author')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Recipes / Create");
      return view('errors.403');
    }

    // find all categories in the categories table and pass them to the view
    //$categories = Category::where('module_id','=','2')->get();
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'recipes');
    })->get();

    // Create an empty array to store the categories
    $cats = [];
    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Recipes / Create");

    return view('recipes.create')->withCategories($cats);
  }

  //==================================================================================================================================
  // STORE :: Store a newly created resource in storage
  //==================================================================================================================================
  public function store(CreateRecipeRequest $request)
  {
    // save the data in the database
    $recipe = new Recipe;

    $recipe->title = $request->title;
    $recipe->ingredients = Purifier::clean($request->ingredients);
    $recipe->methodology = Purifier::clean($request->methodology);
    $recipe->image = $request->image;
    $recipe->category_id = $request->category_id;
    $recipe->servings = $request->servings;
    $recipe->prep_time = $request->prep_time;
    $recipe->cook_time = $request->cook_time;
    $recipe->personal = $request->personal;
    $recipe->published = 0;
    $recipe->source = $request->source;
    $recipe->author_notes = $request->author_notes;
    $recipe->public_notes = $request->public_notes;
    $recipe->user_id = Auth::user()->id;
    $recipe->modified_by_id = Auth::user()->id;
    $recipe->last_viewed_by_id = Auth::user()->id;
    $recipe->last_viewed_on = Carbon::Now();

    // Save the image if there is one
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/recipes/' . $filename);
      Image::make($image)->resize(800, 400)->save($location);

      $recipe->image = $filename;
    }

    $recipe->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") saved :: Recipe " . $recipe->id);

    // set a flash message to be displayed on screen
    Session::flash('success','The recipe was successfully saved!');
    // redirect to another page
    return redirect()->route('recipes.index', 'all');
  }

  //==================================================================================================================================
  // SHOW :: Display the specified resource
  //==================================================================================================================================
  public function show($id)
  {
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
      Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: Recipe (" . $recipe->id . ")");
    } else {
      Log::info(getClientIP() . " viewed :: Recipe (" . $recipe->id . ")");
    }

    return view('recipes.show')->withRecipe($recipe);
  }

  //==================================================================================================================================
  // EDIT :: Show the form for editing the specified resource
  //==================================================================================================================================
  public function edit($id)
  {

    // find the recipe in the db and save it to a variable
    $recipe = Recipe::find($id);

    if(!checkACL('editor') && !checkOwner($recipe)) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Recipes / Edit");
      return view('errors.403');
    }
    
    // find the categories
    //$categories = Category::where('module','=','recipes')->get();
    $categories = Category::whereHas('module', function ($query) {
      $query->where('name', '=', 'recipes');
    })->get();
    
    // Create an empty array to store the categories
    $cats = [];
    // Store the category values into the $cats array
    foreach ($categories as $category) {
      $cats[$category->id] = $category->name;
    }

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") edited :: Recipe (" . $recipe->id . ")");

    // return the view and pass in the variable $recipe
    // also pass in the $cats variable
    return view ('recipes.edit')->withRecipe($recipe)->withCategories($cats);
  }

  //==================================================================================================================================
  // UPDATE :: Update the specified resource in storage
  //==================================================================================================================================
  public function update(UpdateRecipeRequest $request, $id)
  {
    // Get the recipe values from the database
    $recipe = Recipe::find($id);

    // save the data in the database
    $recipe->title = $request->title;
    $recipe->ingredients = Purifier::clean($request->ingredients);
    $recipe->methodology = Purifier::clean($request->methodology);
    $recipe->category_id = $request->category_id;
    $recipe->servings = $request->servings;
    $recipe->prep_time = $request->prep_time;
    $recipe->cook_time = $request->cook_time;
    $recipe->personal = $request->personal;
    $recipe->source = $request->source;
    $recipe->author_notes = $request->author_notes;
    $recipe->public_notes = $request->public_notes;
    $recipe->modified_by_id = Auth::user()->id;
    $recipe->last_viewed_by_id = Auth::user()->id;
    $recipe->last_viewed_on = Carbon::Now();

    // Check if a new image was submitted
    if ($request->hasFile('image')) {
      //Add new photo
      $image = $request->file('image');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/recipes/' . $filename);
      Image::make($image)->resize(800, 400)->save($location);
      
      // get name of old image
      $oldImageName = $recipe->image;
      //dd($oldImageName);

      // Update database
      $recipe->image = $filename;

      // Delete old photo
      //Storage::delete($oldImageName);
      File::delete('images/recipes/'.$oldImageName);
    }

    $recipe->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") updated :: Recipe (" . $recipe->id .")");

    // set a flash message to be displayed on screen
    Session::flash('success','The recipe was successfully updated!');
    // redirect to another page
    return redirect()->route('recipes.index', 'all');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // public function delete($id)
  // {
  //     $recipe = Recipe::find($id);
  //     return view('recipes.delete')->withRecipe($recipe);
  // }

  //==================================================================================================================================
  // DELETE :: Remove the specified resource from storage
  //==================================================================================================================================
  public function destroy($id)
  {
    if(!checkACL('manager')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Recipes / Delete");
      return view('errors.403');
    }

    // Find the recipe in the DB
    $recipe = Recipe::findOrFail($id);

    //Delete the recipe from the DB
    $recipe->delete();

    // Note that the database will take care of deleting all favorites associated with this recipe
    // because onDelete -> Cascade is set in the DB on the foreign key

    // Delete the image if any
    File::delete('images/recipes/' . $recipe->image);

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") deleted :: Recipe (" . $recipe->id . ")");

    // Display a flash message
    Session::flash ('success','The recipe was deleted!');
    // Redirect to the index page
    return redirect()->route('recipes.index','all');
  }

  //==================================================================================================================================
  // VIEW IMAGE
  //==================================================================================================================================
  public function viewImage($id)
  {
    $recipe = Recipe::find($id);
    return view('recipes.viewImage')->withRecipe($recipe);
  }

  //==================================================================================================================================
  // MY RECIPES :: Display a listing of the resource that belong to a specific user.
  //==================================================================================================================================
  public function myRecipes($key)
  {
    if (Auth::check()) {
      $alphas = DB::table('recipes')
          ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
          ->where('user_id','=', Auth::user()->id)
          //->where('published','=', 1)
          ->orderBy('letter')
          ->get();
        //dd($alphas);

        $letters = [];
          foreach($alphas as $alpha) {
            $letters[] = $alpha->letter;
          }
        //dd($letters);

      // if(checkACL('publisher')) {
      //   $pub = 0;
      //   //dd($pub);
      // } else {
      //   $pub = 1;
      // }

      if ($key == 'all') {
        // Display all the user's recipes plus the one from other users that are not marked as personal/private
        //$recipes = Recipe::where('personal','!=',1)->orderBy('title', 'asc')->get();
        //$recipes = Recipe::where('user_id','=', Auth::user()->id)->orderBy('title', 'asc')->get();
        $recipes = Recipe::with('user','category')
          ->where('user_id','=', Auth::user()->id)
          //->where('published','>=', $pub)
          ->orderBy('title', 'asc')
          ->get();
        //return view('recipes.myRecipes', compact('recipes','letters'));
        return view('recipes.index', compact('recipes','letters'));
      }
      if ($key != 'all') {
        //$recipes = Recipe::where('personal', '!=', 1)->where('title', 'like', $key . '%')->get();
        //$recipes = Recipe::where('user_id','=', Auth::user()->id)->where('title', 'like', $key . '%')->orderBy('title', 'asc')->get();
        $recipes = Recipe::with('user','category')
          ->where('user_id','=', Auth::user()->id)
          ->where('title', 'like', $key . '%')
          //->where('published','>=', $pub)
          ->orderBy('title', 'asc')
          ->get();
        //return view('recipes.myRecipes', compact('recipes','letters'));
        return view('recipes.index', compact('recipes','letters'));
      }
    }
  }

  //==================================================================================================================================
  // MY FAVORITES :: Display a listing of the resource that have been favorited by a specific user.
  //==================================================================================================================================
  public function myFavorites($key)
  {
    // $alphas = DB::table('recipes')
    //   ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
    //   //->where('user_id','=',Auth::user()->id)
    //   ->where('user_id','=',-1)
    //   ->orderBy('letter')
    //   ->get();
    // //dd($alphas);

    $letters = [];
    //   foreach($alphas as $alpha) {
    //     $letters[] = $alpha->letter;
    //   }
    // //dd($letters);

    // find the favorites
    $favs = DB::table('recipe_user')
      ->where('user_id','=',Auth::user()->id)
      ->get();
    //$favs = Recipe::with('user','category')->where('recipe_user.user_id','=',Auth::user()->id)->get();
    //$recipes = Recipe::with('user','category')->where('user_id','=', Auth::user()->id)->orderBy('title', 'asc')->get();

    // // Create an empty array to store the recipes        
    $recipes = [];

    // // Store the recipe values into the $recipes array
    foreach ($favs as $fav)
    {
      $recipes[$fav->id] = Recipe::find($fav->recipe_id);
    }
    
    // // Sort the recipes array by title
    $recipes = array_values(array_sort($recipes, function ($value) {
      return $value['title'];
    }));

    // return view('recipes.viewfavorites')->withRecipes($recipes);
    //return view('recipes.myFavorites', compact('recipes','letters'));
    //return view('recipes.index', compact('recipes','letters'));
    return view('recipes.index', compact('recipes','letters'));
  }


  //==================================================================================================================================
  //PUBLISHED :: Display a listing of the resource that have been published.
  //==================================================================================================================================
  public function published($key)
  {
    if(!checkACL('publisher')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Published Recipes");
      return view('errors.403');
    }

    if (Auth::check()) {
      $alphas = DB::table('recipes')
          ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
          //->where('user_id','=', Auth::user()->id)
          ->where('published','=', '1')
          ->orderBy('letter')
          ->get();
        //dd($alphas);

        $letters = [];
          foreach($alphas as $alpha) {
            $letters[] = $alpha->letter;
          }
        //dd($letters);

      // if(checkACL('publisher')) {
      //   $pub = 0;
      //   //dd($pub);
      // } else {
      //   $pub = 1;
      // }

      if ($key == 'all') {
        // Display all the user's recipes plus the one from other users that are not marked as personal/private
        //$recipes = Recipe::where('personal','!=',1)->orderBy('title', 'asc')->get();
        //$recipes = Recipe::where('user_id','=', Auth::user()->id)->orderBy('title', 'asc')->get();
        $recipes = Recipe::with('user','category')
          // ->where('user_id','=', Auth::user()->id)
          ->where('published','=', '1')
          ->orderBy('title', 'asc')
          ->get();
        //return view('recipes.myRecipes', compact('recipes','letters'));
        return view('recipes.index', compact('recipes','letters'));
      }
      if ($key != 'all') {
        //$recipes = Recipe::where('personal', '!=', 1)->where('title', 'like', $key . '%')->get();
        //$recipes = Recipe::where('user_id','=', Auth::user()->id)->where('title', 'like', $key . '%')->orderBy('title', 'asc')->get();
        $recipes = Recipe::with('user','category')
          //->where('user_id','=', Auth::user()->id)
          ->where('title', 'like', $key . '%')
          ->where('published','=', '1')
          ->orderBy('title', 'asc')
          ->get();
        //return view('recipes.myRecipes', compact('recipes','letters'));
        return view('recipes.index', compact('recipes','letters'));
      }
    }
  }

  //==================================================================================================================================
  //NON PUBLISHED :: Display a listing of the resource that have NOT been published.
  //==================================================================================================================================
  public function nonPublished($key)
  {
    if(!checkACL('publisher')) {
      // Save entry to log file of failure
      Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Non Published Recipes");
      return view('errors.403');
    }

    if (Auth::check()) {
      $alphas = DB::table('recipes')
          ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
          //->where('user_id','=', Auth::user()->id)
          ->where('published','=', '0')
          ->orderBy('letter')
          ->get();
        //dd($alphas);

        $letters = [];
          foreach($alphas as $alpha) {
            $letters[] = $alpha->letter;
          }
        //dd($letters);

      // if(checkACL('publisher')) {
      //   $pub = 0;
      //   //dd($pub);
      // } else {
      //   $pub = 1;
      // }

      if ($key == 'all') {
        // Display all the user's recipes plus the one from other users that are not marked as personal/private
        //$recipes = Recipe::where('personal','!=',1)->orderBy('title', 'asc')->get();
        //$recipes = Recipe::where('user_id','=', Auth::user()->id)->orderBy('title', 'asc')->get();
        $recipes = Recipe::with('user','category')
          // ->where('user_id','=', Auth::user()->id)
          ->where('published','=', '0')
          ->orderBy('title', 'asc')
          ->get();
        //return view('recipes.myRecipes', compact('recipes','letters'));
        return view('recipes.index', compact('recipes','letters'));
      }
      if ($key != 'all') {
        //$recipes = Recipe::where('personal', '!=', 1)->where('title', 'like', $key . '%')->get();
        //$recipes = Recipe::where('user_id','=', Auth::user()->id)->where('title', 'like', $key . '%')->orderBy('title', 'asc')->get();
        $recipes = Recipe::with('user','category')
          //->where('user_id','=', Auth::user()->id)
          ->where('title', 'like', $key . '%')
          ->where('published','=', '0')
          ->orderBy('title', 'asc')
          ->get();
        //return view('recipes.myRecipes', compact('recipes','letters'));
        return view('recipes.index', compact('recipes','letters'));
      }
    }
  }

  //==================================================================================================================================
  // ADD FAVORITE
  //==================================================================================================================================
  public function addfavorite($id)
  {
    $user = Auth::user()->id;
    $recipe = Recipe::find($id);

    $recipe->favorites()->sync([$user], false);

    Session::flash ('success','The recipe was successfully added to your Favorites list!');
    return redirect()->route('recipes.myFavorites','all');
  }

  //==================================================================================================================================
  // REMOVE FAVORITE
  //==================================================================================================================================
  public function removefavorite($id)
  {
    $user = Auth::user()->id;
    $recipe = Recipe::find($id);

    $recipe->favorites()->detach($user);

    Session::flash ('success','The recipe was successfully removed to your Favorites list!');
    // return redirect()->route('recipes.index','all');
    return redirect()->route('recipes.myFavorites','all');
  }

  //==================================================================================================================================
  // DELETE IMAGE
  //==================================================================================================================================
  public function deleteImage($id)
  {
    // Find the user
    $recipe = Recipe::find($id);

    // Delete the image from the system
    File::delete('images/recipes/' . $recipe->image);
    
    // Update database
    $recipe->image = NULL;
    $recipe->save();

    // Set flash data with success message
    Session::flash ('success', 'The recipe image was successfully removed!');
    return view('recipes.show')->withRecipe($recipe);
  }

  //==================================================================================================================================
  // PRINT RECIPE
  //==================================================================================================================================
  public function printRecipe($id)
  {
    $recipe = Recipe::find($id);

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") PRINTED recipe (" . $recipe->id . ")\r\n", [json_decode($recipe, true)]);

    return view('recipes.print')->withRecipe($recipe);
  }

  //==================================================================================================================================
  // SHOW USER
  //==================================================================================================================================
  public function showUser($id)
  {
    $user = User::find($id);
    return view('recipes.showUser')->withUser($user);
  }

  //==================================================================================================================================
  // MAKE PRIVATE
  //==================================================================================================================================
  public function makeprivate($id)
  {
    $recipe = Recipe::find($id);
      $recipe->personal = 1;
    $recipe->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") MADE recipe (" . $recipe->id . ") PRIVATE \r\n", [json_decode($recipe, true)]);

    Session::flash('success','The recipe was made private successfully');
    return redirect()->route('recipes.index','all');
  }

  //==================================================================================================================================
  // REMOVE PRIVATE
  //==================================================================================================================================
  public function removeprivate($id)
  {
    $recipe = Recipe::find($id);
        $recipe->personal = 0;
    $recipe->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") REMOVE PRIVATE from recipe (" . $recipe->id . ")\r\n", 
        [json_decode($recipe, true)]
    );

    Session::flash('success','The recipe was removed from private successfully');
    return redirect()->route('recipes.index','all');
  }

  //==================================================================================================================================
  // ARCHIVE
  //==================================================================================================================================
  public function archive($year, $month)
  {
    $archives = Recipe::whereYear('published_at','=', $year)
      ->whereMonth('published_at','=', $month)
      ->where('published','=',1)
      ->get();

    // Save the URL in a varibale so it can be used in the blog.single page to redirect the user to the archives list page
    Session::flash('backUrl', Request::fullUrl());
    return view('recipes.archive')->withArchives($archives)->withYear($year)->withMonth($month);
  }

  //==================================================================================================================================
  // PUBLISH
  //==================================================================================================================================
  public function publish($id)
  {
    $recipe = Recipe::find($id);
      $recipe->published = 1;
      $recipe->published_at = Carbon::now();
    $recipe->save();

    Session::flash ('success','The recipe was successfully published');
    return redirect()->route('recipes.index','all');
  }

  //==================================================================================================================================
  // UN-PUBLISH
  //==================================================================================================================================
  public function unpublish($id)
  {
    $recipe = Recipe::find($id);
      $recipe->published = 0;
      $recipe->published_at = NULL;
    $recipe->save();

    // Remove favorites
    DB::table('recipe_user')->where('recipe_id', '=', $recipe->id)->delete();

    Session::flash ('success','The recipe was successfully un-published');
    return redirect()->route('recipes.index','all');
  }
}
