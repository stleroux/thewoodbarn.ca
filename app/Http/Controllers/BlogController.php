<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests;
use DB;
use Session;
use Carbon\Carbon;
use Auth;
use Log;
use Redirect;

class BlogController extends Controller
{
	// ================================================================================================================================
	// CONSTRUCT ::
	// ================================================================================================================================
	public function __construct() {
		Log::useFiles(storage_path().'/logs/audits.log');
	}


	public function getIndex()
	{
		// Save entry to log file using built-in Monolog
		if(Auth::check()) {
			Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Blog");
		}else{
			Log::info(getClientIP() . " accessed :: Blog");
		}

		$posts = Post::with('user')->orderBy('id','desc')->paginate(5);
		return view ('blog.index')->withPosts($posts);
	}


	public function getSingle($slug)
	{
		// fetch from database based on slug
		$post = Post::where('slug', '=', $slug)->first();

		// Add 1 to views column
		DB::table('posts')->increment('views', 1);

		$post->save();

		// Save entry to log file using built-in Monolog
		if(Auth::check()) {
			Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: Post (" . $post->id . ")");
		}else{
			//Log::info(getClientIP() . " viewed :: Post id (" . $post->id . ")";
			Log::info(getClientIP() . " viewed :: Post (" . $post->id . ")");
		}

		// return the view and pass in the post object
		return view('blog.single')->withPost($post);
	}


	public function archive($year, $month)
	{

		$archives = Post::whereYear('created_at','=', $year)
			->whereMonth('created_at','=', $month)
			->get();

		// Save the URL in a varibale so it can be used in the blog.single page to redirect the user to the archives list page
		Session::flash('backUrl', \Request::fullUrl());

		return view('blog.archive')->withArchives($archives)->withYear($year)->withMonth($month);
	}


	// public function viewImage($id)
	// {
	// 	// Save entry to log file using built-in Monolog
	// 	if(Auth::check()) {
	// 		Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: Image of Post (" . $id . ")");
	// 	}else{
	// 		//Log::info(getClientIP() . " viewed :: Post id (" . $post->id . ")";
	// 		Log::info(getClientIP() . " viewed :: Image of Post (" . $id . ")");
	// 	}
	// }


}
