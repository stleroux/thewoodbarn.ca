<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Audit;
use Auth;
use Log;

class AuditController extends Controller
{
	// ================================================================================================================================
	// CONSTRUCT :: 
	// ================================================================================================================================
	public function __construct() {
		// only allow authenticated users to access these pages
		$this->middleware('auth');
		Log::useFiles(storage_path().'/logs/audits.log');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if(!checkACL('manager')) {
			// Save entry to log file of failure
			Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Audits");
			return view('errors.403');
		}

		// Save entry to log file using built-in Monolog
		Log::info(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Admin / Audits");

		$audits = Audit::orderBy('id','desc')->with('user')->get();
		return view('admin.audits.index', compact('audits'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
