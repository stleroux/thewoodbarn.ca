<?php
/*
|--------------------------------------------------------------------------
| ROLES ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('roles',[
// 	'uses'=>'RoleController@index',
// 	'as'=>'roles.index'
// 	]);

/*
|--------------------------------------------------------------------------
| ROLES ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('roles', [
	'uses'=>'RoleController@index',
	'as'=>'roles.index'
	]);

Route::get('roles/create',[
	'uses'=>'RoleController@create',
	'as'=>'roles.create'
	]);

Route::post('roles',[
	'uses'=>'RoleController@store',
	'as'=>'roles.store'
	]);

Route::get('roles/import',[
	'uses' => 'RoleController@import',
	'as' => 'roles.import'
	]);

Route::get('roles/{id}',[
	'uses'=>'RoleController@show',
	'as'=>'roles.show'
	]);

Route::get('roles/{id}/edit',[
	'uses'=>'RoleController@edit',
	'as'=>'roles.edit'
	]);

Route::put('roles/{id}',[
	'uses'=>'RoleController@update',
	'as'=>'roles.update'
	]);

Route::get('roles/{id}/delete',[
	'uses'=>'RoleController@delete',
	'as'=>'roles.delete'
	]);

Route::delete('roles/{id}',[
	'uses'=>'RoleController@destroy',
	'as'=>'roles.destroy'
	]);

Route::get('roles/exportPDF',[
	'uses' => 'RoleController@exportPDF',
	'as' => 'roles.exportPDF'
	]);



Route::get('roles/downloadExcel/{type}',[
	'uses' => 'RoleController@downloadExcel',
	'as' => 'roles.downloadExcel'
	]);

Route::post('roles/importExcel',[
	'uses' => 'RoleController@importExcel',
	'as' => 'roles.importExport'
	]);
