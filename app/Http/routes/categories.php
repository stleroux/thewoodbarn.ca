<?php
/*
|--------------------------------------------------------------------------
| CATEGORIES ROUTES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| CATEGORIES ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('categories', [
	'uses' => 'CategoryController@index',
	'as' => 'categories.index'
	]);

Route::get('categories/create', [
	'uses' => 'CategoryController@create',
	'as' => 'categories.create'
	]);

Route::post('categories/store', [
	'uses' => 'CategoryController@store',
	'as' => 'categories.store'
	]);

Route::get('categories/{id}/edit', [
	'uses' => 'CategoryController@edit',
	'as' => 'categories.edit'
	]);

Route::put('categories/{id}', [
	'uses' => 'CategoryController@update',
	'as' => 'categories.update'
	]);

Route::get('categories/{id}/delete', [
	'uses' => 'CategoryController@delete',
	'as' => 'categories.delete'
]);

Route::delete('categories/{id}', [
 	'uses' => 'CategoryController@destroy',
 	'as' => 'categories.destroy'
 	]);

Route::get('categories/exportPDF',[
	'uses' => 'CategoryController@exportPDF',
	'as' => 'categories.exportPDF'
	]);

Route::get('categories/import',[
	'uses' => 'CategoryController@import',
	'as' => 'categories.import'
	]);

Route::get('categories/downloadExcel/{type}',[
	'uses' => 'CategoryController@downloadExcel',
	'as' => 'categories.downloadExcel'
	]);

Route::post('categories/importExcel',[
	'uses' => 'CategoryController@importExcel',
	'as' => 'categories.importExport'
	]);
