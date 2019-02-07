<?php
/*
|--------------------------------------------------------------------------
| MODULES ROUTES
|--------------------------------------------------------------------------
*/


// Route::get('modules', [
// 	'uses' => 'ModuleController@index',
// 	'as' => 'modules.index'
// 	]);

// Route::get('modules/{id}/show', [
// 	'uses' => 'ModuleController@show',
// 	'as' => 'modules.show'
// 	]);

// Route::get('modules/create', [
// 	'uses' => 'ModuleController@create',
// 	'as' => 'modules.create'
// 	]);

// Route::post('modules', [
// 	'uses' => 'ModuleController@store',
// 	'as' => 'modules.store'
// 	]);

// Route::get('/modules/{id}/edit', [
// 	'uses' => 'ModuleController@edit',
// 	'as' => 'modules.edit'
// 	]);

// Route::put('modules/{id}', [
// 	'uses' => 'ModuleController@update',
// 	'as' => 'modules.update'
// 	]);

// Route::get('modules/{id}/delete', [
// 	'uses' => 'ModuleController@delete',
// 	'as' => 'modules.delete'
// ]);

// Route::delete('modules/{id}', [
//  	'uses' => 'ModuleController@destroy',
//  	'as' => 'modules.destroy'
//  	]);



/*
|--------------------------------------------------------------------------
| MODULES ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('modules', [
	'uses'=>'ModuleController@index',
	'as'=>'modules.index'
	]);

Route::get('modules/{id}/show', [
	'uses' => 'ModuleController@show',
	'as' => 'modules.show'
	]);

Route::get('modules/create', [
	'uses' => 'ModuleController@create',
	'as' => 'modules.create'
	]);

Route::post('modules', [
	'uses' => 'ModuleController@store',
	'as' => 'modules.store'
	]);

Route::get('modules/{id}/edit', [
	'uses' => 'ModuleController@edit',
	'as' => 'modules.edit'
	]);

Route::put('modules/{id}', [
	'uses' => 'ModuleController@update',
	'as' => 'modules.update'
	]);

Route::get('modules/{id}/delete', [
	'uses' => 'ModuleController@delete',
	'as' => 'modules.delete'
]);

Route::delete('modules/{id}', [
 	'uses' => 'ModuleController@destroy',
 	'as' => 'modules.destroy'
 	]);

Route::get('modules/exportPDF',[
	'uses' => 'ModuleController@exportPDF',
	'as' => 'modules.exportPDF'
	]);

Route::get('modules/import',[
	'uses' => 'ModuleController@import',
	'as' => 'modules.import'
	]);

Route::get('modules/downloadExcel/{type}',[
	'uses' => 'ModuleController@downloadExcel',
	'as' => 'modules.downloadExcel'
	]);

Route::post('modules/importExcel',[
	'uses' => 'ModuleController@importExcel',
	'as' => 'modules.importExport'
	]);
