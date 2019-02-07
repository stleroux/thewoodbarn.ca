<?php
/*
|--------------------------------------------------------------------------
| TAGS ROUTES
|--------------------------------------------------------------------------
*/

// Route::get('tasks', [
// 	'uses' => 'TaskController@index',
// 	'as' => 'tasks.index'
// 	]);

/*
|--------------------------------------------------------------------------
| TAGS ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('tasks', [
	'uses' => 'TaskController@index',
	'as' => 'tasks.index'
	]);

Route::get('tasks/create', [
	'uses' => 'TaskController@create',
	'as' => 'tasks.create'
	]);

Route::post('tasks/store', [
	'uses' => 'TaskController@store',
	'as' => 'tasks.store'
	]);

Route::get('tasks/{id}/edit', [
	'uses' => 'TaskController@edit',
	'as' => 'tasks.edit'
	]);

Route::put('tasks/{id}', [
	'uses' => 'TaskController@update',
	'as' => 'tasks.update'
	]);

Route::get('tasks/{id}/delete',[
	'uses'=>'TaskController@delete',
	'as'=>'tasks.delete'
	]);

Route::delete('tasks/{id}/destroy', [
	'uses' => 'TaskController@destroy',
	'as' => 'tasks.destroy'
	]);

Route::get('tasks/{id}/duplicate', [
	'uses' => 'TaskController@duplicate',
	'as' => 'tasks.duplicate'
	]);

Route::get('tasks/exportPDF',[
	'uses' => 'TaskController@exportPDF',
	'as' => 'tasks.exportPDF'
	]);

Route::get('tasks/import',[
	'uses' => 'TaskController@import',
	'as' => 'tasks.import'
	]);

Route::get('tasks/downloadExcel/{type}',[
	'uses' => 'TaskController@downloadExcel',
	'as' => 'tasks.downloadExcel'
	]);

Route::post('tasks/importExcel',[
	'uses' => 'TaskController@importExcel',
	'as' => 'tasks.importExport'
	]);
