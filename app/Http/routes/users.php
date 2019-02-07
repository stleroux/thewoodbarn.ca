<?php
/*
|--------------------------------------------------------------------------
| USERS ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('users',[
// 	'uses'=>'UserController@index',
// 	'as'=>'users.index'
// 	]);

/*
|--------------------------------------------------------------------------
| USERS ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('users',[
	'uses'=>'UserController@index',
	'as'=>'users.index'
	]);

Route::get('users/create',[
	'uses'=>'UserController@create',
	'as'=>'users.create'
	]);

Route::post('users',[
	'as'=>'users.store',
	'uses'=>'UserController@store'
	]);

Route::get('users/import',[
	'uses' => 'UserController@import',
	'as' => 'users.import'
	]);

Route::get('users/{id}',[
	'as'=>'users.show',
	'uses'=>'UserController@show'
	]);

Route::get('users/{id}/edit',[
	'as'=>'users.edit',
	'uses'=>'UserController@edit'
	]);

Route::put('users/{id}',[
	'as'=>'users.update',
	'uses'=>'UserController@update'
	]);

Route::get('users/{id}/delete',[
	'as'=>'users.delete',
	'uses'=>'UserController@delete'
	]);

Route::delete('users/{id}',[
	'as'=>'users.destroy',
	'uses'=>'UserController@destroy'
	]);

Route::get('users/exportPDF',[
	'uses' => 'UserController@exportPDF',
	'as' => 'users.exportPDF'
	]);

Route::get('users/downloadExcel/{type}',[
	'uses' => 'UserController@downloadExcel',
	'as' => 'users.downloadExcel'
	]);

Route::post('users/importExcel',[
	'uses' => 'UserController@importExcel',
	'as' => 'users.importExport'
	]);

Route::get('users/resetpwd/{id}', [
	'uses' => 'UserController@resetPassword',
    'as' => 'users.resetPassword'
 ]);

Route::post('users/updatePassword/{id}', [
	'uses' => 'UserController@updatePassword',
    'as' => 'users.updatePassword'
 ]);

Route::get('users/{id}/activate', [
	'uses' => 'UserController@activate',
    'as' => 'users.activate'
 ]);

Route::get('users/{id}/deactivate', [
	'uses' => 'UserController@deactivate',
    'as' => 'users.deactivate'
 ]);

