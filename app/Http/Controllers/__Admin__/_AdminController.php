<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Post;
use App\Recipe;
use App\User;
use Auth;
use Storage;
use Log;

class AdminController extends Controller
{

  // ================================================================================================================================
  // CONSTRUCT :: 
  // ================================================================================================================================
  public function __construct() {
    // only allow authenticated users to access these pages
    $this->middleware('auth');
    Log::useFiles(storage_path().'/logs/audits.log');
  }

	public function index()
	{
		if(!checkACL('manager')) {
			// Save entry to log file of failure
			//if(Auth::check()) {
				Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin");	
			//}
			return view('errors.403');
		}

		$latestArticles = Article::orderBy('created_at','desc')->take(5)->get();
		$latestRecipes = Recipe::orderBy('created_at','desc')->take(5)->get();
		$latestPosts = Post::orderBy('created_at','desc')->take(5)->get();
		$newUsers = User::where('active','=','0')->where('selfRegistered','=',1)->get();

		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin");

		return view ('admin.index', compact('latestArticles','latestRecipes','latestPosts','newUsers'));
	}

	public function test1() {
		return view('admin.test1');
	}

 }