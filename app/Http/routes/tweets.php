<?php
/*
|--------------------------------------------------------------------------
| TWEETS ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('tweets', [
// 	'uses' => 'TweetController@index',
// 	'as' => 'tweets.index'
// 	]);

// Route::get('tweets/{id}/show', [
// 	'uses' => 'TweetController@show',
// 	'as' => 'tweets.show'
// 	]);

// Route::get('tweets/create', [
// 	'uses' => 'TweetController@create',
// 	'as' => 'tweets.create'
// 	]);

// Route::post('tweets', [
// 	'uses' => 'TweetController@store',
// 	'as' => 'tweets.store'
// 	]);

// Route::get('/tweets/{id}/edit', [
// 	'uses' => 'TweetController@edit',
// 	'as' => 'tweets.edit'
// 	]);

// Route::put('tweets/{id}', [
// 	'uses' => 'TweetController@update',
// 	'as' => 'tweets.update'
// 	]);

// Route::get('tweets/{id}/delete', [
// 	'uses' => 'TweetController@delete',
// 	'as' => 'tweets.delete'
// ]);

// Route::delete('tweets/{id}', [
//  	'uses' => 'TweetController@destroy',
//  	'as' => 'tweets.destroy'
//  	]);

/*
|--------------------------------------------------------------------------
| TWEETS ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('tweets', [
	'uses' => 'TweetController@index',
	'as' => 'tweets.index'
	]);

Route::get('tweets/{id}/show', [
	'uses' => 'TweetController@show',
	'as' => 'tweets.show'
	]);

Route::get('tweets/create', [
	'uses' => 'TweetController@create',
	'as' => 'tweets.create'
	]);

Route::post('tweets', [
	'uses' => 'TweetController@store',
	'as' => 'tweets.store'
	]);

Route::get('tweets/{id}/edit', [
	'uses' => 'TweetController@edit',
	'as' => 'tweets.edit'
	]);

Route::put('tweets/{id}', [
	'uses' => 'TweetController@update',
	'as' => 'tweets.update'
	]);

Route::get('tweets/{id}/delete', [
	'uses' => 'TweetController@delete',
	'as' => 'tweets.delete'
]);

Route::delete('tweets/{id}', [
 	'uses' => 'TweetController@destroy',
 	'as' => 'tweets.destroy'
 	]);

Route::get('tweets/exportPDF',[
	'uses' => 'TweetController@exportPDF',
	'as' => 'tweets.exportPDF'
	]);

Route::get('tweets/import',[
	'uses' => 'TweetController@import',
	'as' => 'tweets.import'
	]);

Route::get('tweets/downloadExcel/{type}',[
	'uses' => 'TweetController@downloadExcel',
	'as' => 'tweets.downloadExcel'
	]);

Route::post('tweets/importExcel',[
	'uses' => 'TweetController@importExcel',
	'as' => 'tweets.importExport'
	]);
