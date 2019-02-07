<?php
/*
|--------------------------------------------------------------------------
| POSTS ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('posts', [
// 	'uses' => 'PostController@index',
// 	'as' => 'posts.index'
// 	]);

// Route::get('posts/{id}/show', [
// 	'uses' => 'PostController@show',
// 	'as' => 'posts.show'
// 	]);

// Route::get('posts/create', [
// 	'uses' => 'PostController@create',
// 	'as' => 'posts.create'
// 	]);

// Route::post('posts/store', [
// 	'uses' => 'PostController@store',
// 	'as' => 'posts.store'
// 	]);

// Route::get('posts/{id}/edit', [
// 	'uses' => 'PostController@edit',
// 	'as' => 'posts.edit'
// 	]);

// Route::put('posts/{id}', [
// 	'uses' => 'PostController@update',
// 	'as' => 'posts.update'
// 	]);

// Route::delete('posts/{id}', [
//  	'uses' => 'PostController@destroy',
//  	'as' => 'posts.destroy'
//  	]);

// Route::get('posts/{id}/viewImage', [
// 	'uses'=>'PostController@viewImage',
// 	'as'=>'posts.viewImage'
// 	]);

// Route::post('posts/{id}/deleteImage', [
// 	'uses' => 'PostController@deleteImage',
// 	'as' => 'posts.deleteImage'
// 	]);

// Route::get('/posts/{id}/showUser', [
// 	'uses' => 'PostController@showUser',
// 	'as' => 'posts.showUser'
// 	]);


/*
|--------------------------------------------------------------------------
| POSTS ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('posts', [
	'uses' => 'PostController@index',
	'as' => 'posts.index'
	]);

Route::get('posts/{id}/show', [
	'uses' => 'PostController@show',
	'as' => 'posts.show'
	]);

Route::get('posts/create', [
	'uses' => 'PostController@create',
	'as' => 'posts.create'
	]);

Route::post('posts', [
	'uses' => 'PostController@store',
	'as' => 'posts.store'
	]);

Route::get('posts/{id}/edit', [
	'uses' => 'PostController@edit',
	'as' => 'posts.edit'
	]);

Route::put('posts/{id}', [
	'uses' => 'PostController@update',
	'as' => 'posts.update'
	]);

Route::delete('posts/{id}/deleteImage', [
	'uses' => 'PostController@deleteImage',
	'as' => 'posts.deleteImage'
	]);

Route::delete('posts/{id}', [
 	'uses' => 'PostController@destroy',
 	'as' => 'posts.destroy'
 	]);

Route::get('posts/{id}/viewImage', [
	'uses'=>'PostController@viewImage',
	'as'=>'posts.viewImage'
	]);

Route::get('posts/{id}/showUser', [
	'uses' => 'PostController@showUser',
	'as' => 'posts.showUser'
	]);

Route::get('posts/exportPDF',[
	'uses' => 'PostController@exportPDF',
	'as' => 'posts.exportPDF'
	]);

Route::get('posts/import',[
	'uses' => 'PostController@import',
	'as' => 'posts.import'
	]);

Route::get('posts/downloadExcel/{type}',[
	'uses' => 'PostController@downloadExcel',
	'as' => 'posts.downloadExcel'
	]);

Route::post('posts/importExcel',[
	'uses' => 'PostController@importExcel',
	'as' => 'posts.importExport'
	]);

Route::get('posts/{id}/print', [
	'uses' => 'PostController@printPost',
	'as' => 'posts.print'
	]);