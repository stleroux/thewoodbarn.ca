<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Item;
use App\Post;
use App\Recipe;
use App\Task;
use App\Tweet;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;
use Log;
use Mail;
use Session;
//use Request;

use GuzzleHttp\Client;

class PageController extends Controller {

  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct() {
    Log::useFiles(storage_path().'/logs/audits.log');
  }

	public function getIndex() {
		// Query builder (Eloquent)
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		
		$popularPost = Post::get()->sortByDesc('views')->take(1);
		$popularRecipe = Recipe::get()->sortByDesc('views')->take(1);

		// Get list of posts by year and month
		$postlinks = DB::table('posts')
			->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) post_count'))
			//->where('created_at', '<=', Carbon::now()->subMonth(3))
			->groupBy('year')
			->groupBy('month')
			->orderBy('year', 'desc')
			->orderBy('month', 'desc')
			->get();

		// Get list of posts by year and month
		$recipelinks = DB::table('recipes')
			->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) post_count'))
			//->where('created_at', '<=', Carbon::now()->subMonth(3))
			//->whereRaw('published = 1')
			->groupBy('year')
			->groupBy('month')
			->orderBy('year', 'desc')
			->orderBy('month', 'desc')
			->get();

		// Save entry to log file using built-in Monolog
		if(Auth::check()) {
			Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Home");
		}else{
			Log::info(getClientIP() . " accessed :: Home");
		}

		return view ('welcome')
			->withPosts($posts)
			->withPopularpost($popularPost)
			->withPopularrecipe($popularRecipe)
			->withPostlinks($postlinks)
			->withRecipelinks($recipelinks);
	}


	public function getAbout() {
		$first_name = 'Stephane';
		$last_name	= 'Leroux';
		$full_name	= $first_name . " " . $last_name;
		$email		= 'stephane.leroux@dfo-mpo.gc.ca';

		$data = [];
		$data['first_name']	= $first_name;
		$data['last_name']	= $last_name;
		$data['full_name']	= $full_name;
		$data['email']		= $email;

		// Save entry to log file using built-in Monolog
		if(Auth::check()) {
			Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: About");
		}else{
			Log::info(getClientIP() . " accessed :: About");
		}

		return view('about')->withData($data);
	}


	public function getContact() {
		
		// Save entry to log file using built-in Monolog
		if(Auth::check()) {
			Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Contact");
		}else{
			Log::info(getClientIP() . " accessed :: Contact");
		}

		return view ('contact');
	}

	public function postContact(Request $request) {
		// used to submit the info from the contact page to the database
		$this->validate($request, [
			'email'		=> 'required|email',
			'subject'	=> 'required|min:3',
			'message'	=> 'required|min:10'
		]);

		$data = array(
			'email'			=> $request->email,
			'subject'		=> $request->subject,
			'bodyMessage'	=> $request->message
		);

		$token = $request->input('g-recaptcha-response');

		if ($token) {
			$client = new Client(); //Initialize a new Guzzle object
			$response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
				'form_params' => array(
					'secret' 	=> '6LduZyYTAAAAABwoIAzzUhovfTPOFBwvPclynrNO',
					'response'	=> $token
					)
				]);
			$results = json_decode($response->getBody()->getContents());

			if ($results->success) {
				Session::flash('success','Yes we know you are human');
			} else {
				Session::flash('error','You are probably a robot');
			}
		}

		// use Mail::queue() to send multiple emails at a later time
		Mail::send('emails.contact', $data, function($message) use ($data) {
			$message->from($data['email']);
			$message->to('stleroux@hotmail.ca');
			$message->subject($data['subject']);
		}); 

		// Save entry to log file using built-in Monolog
		if(Auth::check()) {
			Log::info(Auth::user()->username . " (" . Auth::user()->id . ") submitted :: Contact");
		}else{
			Log::info(getClientIP() . " submitted :: Contact");
		}

		Session::flash('success','Your email was sent!');
		return redirect()->url('/');
	}

	public function template() {
		return view ('template');
	}

	public function getNewReg() {
		return view ('new_reg');
	}

	public function getDashboard() {

		if(!checkACL('user')) {
			// Save entry to log file of failure
			Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Dashboard");
			return view('errors.403');
		}
		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Dashboard");

		$latestArticles = Article::orderBy('created_at','desc')->take(5)->get();
		$latestRecipes = Recipe::orderBy('created_at','desc')->take(5)->get();
		$latestTweets = Tweet::orderBy('created_at','desc')->take(5)->get();
		$newUsers = User::where('active','=','0')->where('selfRegistered','=',1)->get();

		return view ('dashboard', compact('latestRecipes','latestTweets','latestArticles','newUsers'));
	}

	public function test() {
		return view ('1');
	}

	public function admin()
	{
		if(!checkACL('manager')) {
			// Save entry to log file of failure
			if(Auth::check()) {
				Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin");	
			}
			return view('errors.403');
		}

		$latestArticles = Article::orderBy('created_at','desc')->take(5)->get();
		$latestRecipes = Recipe::orderBy('created_at','desc')->take(5)->get();
		$latestPosts = Post::orderBy('created_at','desc')->take(5)->get();
		$newUsers = User::where('active','=','0')->where('selfRegistered','=',1)->get();

		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin");

		return view ('__admin.index', compact('latestArticles','latestRecipes','latestPosts','newUsers'));
	}
}