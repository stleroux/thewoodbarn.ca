<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tweet;
use Auth;
use Log;
use Session;

use App\Http\Requests\CreateTweetRequest;
use App\Http\Requests\UpdateTweetRequest;

class TweetController extends Controller {

    public function __construct() {
        // only allow authenticated users to access these pages
        $this->middleware('auth', ['except'=>['index','show']]);
        // changing auth to guest would only allow guests to access these pages
        // you can also restrict the actions by adding ['except' => 'name_of_action'] at the end

        Log::useFiles(storage_path().'/logs/tweets.log');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tweets = Tweet::orderBy('title')->get();
		return view('tweets.index', compact('tweets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tweets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(CreateTweetRequest $request)
	{
		$tweet = new Tweet();
			$tweet->title = $request->input("title");
    	    $tweet->body = $request->input("body");
    	    $tweet->user_id = Auth::user()->id;
		$tweet->save();

		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED tweet (" . $tweet->id . ")\r\n",
			[$tweet = json_decode($tweet, true)]
		);

		// set a flash message to be displayed on screen
        Session::flash('success','The tweet was successfully added!');

		return redirect()->route('tweets.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tweet = Tweet::findOrFail($id);

		// Save entry to log file using built-in Monolog
		if (Auth::check()) {
			Log::info(
				Auth::user()->username . " (" . Auth::user()->id . ") VIEWED tweet (" . $tweet->id . ")");
		} else {
			Log::info('Guest viewed tweet id ' . $tweet->id);
		}

		return view('tweets.show', compact('tweet'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tweet = Tweet::findOrFail($id);
		return view('tweets.edit', compact('tweet'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(UpdateTweetRequest $request, $id)
	{
		$tweet = Tweet::findOrFail($id);
			$tweet->title = $request->input("title");
    	    $tweet->body = $request->input("body");
		$tweet->save();
		
		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . "( " . Auth::user()->id . ") UPDATED tweet (" . $tweet->id . ")\r\n",
			[$tweet = json_decode($tweet, true)]
		);

		// set a flash message to be displayed on screen
        Session::flash('success','The tweet was successfully updated!');

		return redirect()->route('tweets.index');
	}

    public function delete($id)
    {
        $tweet = Tweet::find($id);
        return view('tweets.delete', compact('tweet'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tweet = Tweet::findOrFail($id);
		$tweet->delete();

		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . "( " . Auth::user()->id . ") DELETED tweet (" . $tweet->id . ")\r\n",
			[$tweet = json_decode($tweet, true)]
		);

		// set a flash message to be displayed on screen
        Session::flash('success','The tweet was successfully deleted!');

		return redirect()->route('tweets.index');
	}

}
