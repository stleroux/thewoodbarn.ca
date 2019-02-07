<?php
/*
|--------------------------------------------------------------------------
| PRODUCTS ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('products', [
// 	'uses' => 'ProductController@index',
// 	'as' => 'products.index'
// 	]);

// Route::get('products/{id}/show', [
// 	'uses' => 'ProductController@show',
// 	'as' => 'products.show'
// 	]);

// Route::get('products/create', [
// 	'uses' => 'ProductController@create',
// 	'as' => 'products.create'
// 	]);

/*
|--------------------------------------------------------------------------
| PRODUCTS ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('products', [
	'uses' => 'ProductController@index',
	'as' => 'products.index'
	]);

Route::get('products/{id}/show', [
	'uses' => 'ProductController@show',
	'as' => 'products.show'
	]);

Route::get('products/create', [
	'uses' => 'ProductController@create',
	'as' => 'products.create'
	]);

Route::post('products', [
	'uses' => 'ProductController@store',
	'as' => 'products.store'
	]);

Route::get('products/{id}/edit', [
	'uses' => 'ProductController@edit',
	'as' => 'products.edit'
	]);

Route::put('products/{id}', [
	'uses' => 'ProductController@update',
	'as' => 'products.update'
	]);

Route::get('products/{id}/delete', [
	'uses' => 'ProductController@delete',
	'as' => 'products.delete'
]);

Route::delete('products/{id}', [
 	'uses' => 'ProductController@destroy',
 	'as' => 'products.destroy'
 	]);

Route::get('products/exportPDF',[
	'uses' => 'ProductController@exportPDF',
	'as' => 'products.exportPDF'
	]);

Route::get('products/import',[
	'uses' => 'ProductController@import',
	'as' => 'products.import'
	]);

Route::get('products/downloadExcel/{type}',[
	'uses' => 'ProductController@downloadExcel',
	'as' => 'products.downloadExcel'
	]);

Route::post('products/importExcel',[
	'uses' => 'ProductController@importExcel',
	'as' => 'products.importExport'
	]);
