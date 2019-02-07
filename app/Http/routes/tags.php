<?php
/*
|--------------------------------------------------------------------------
| TAGS ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('tags', [
// 	'uses' => 'TagController@index',
// 	'as' => 'tags.index'
// 	]);

/*
|--------------------------------------------------------------------------
| TAGS ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('tags', [
	'uses' => 'TagController@index',
	'as' => 'tags.index'
	]);

Route::get('tags/create', [
	'uses' => 'TagController@create',
	'as' => 'tags.create'
	]);

Route::post('tags/store', [
	'uses' => 'TagController@store',
	'as' => 'tags.store'
	]);

Route::get('tags/{id}/edit', [
	'uses' => 'TagController@edit',
	'as' => 'tags.edit'
	]);

Route::put('tags/{id}', [
	'uses' => 'TagController@update',
	'as' => 'tags.update'
	]);

Route::get('tags/{id}/show', [
	'uses' => 'TagController@show',
	'as' => 'tags.show'
	]);

Route::get('tags/{id}/delete',[
	'uses'=>'TagController@delete',
	'as'=>'tags.delete'
	]);

Route::delete('tags/{id}/delete', [
	'uses' => 'TagController@destroy',
	'as' => 'tags.destroy'
	]);

Route::get('tags/exportPDF',[
	'uses' => 'TagController@exportPDF',
	'as' => 'tags.exportPDF'
	]);

Route::get('tags/import',[
	'uses' => 'TagController@import',
	'as' => 'tags.import'
	]);

Route::get('tags/downloadExcel/{type}',[
	'uses' => 'TagController@downloadExcel',
	'as' => 'tags.downloadExcel'
	]);

Route::post('tags/importExcel',[
	'uses' => 'TagController@importExcel',
	'as' => 'tags.importExport'
	]);
