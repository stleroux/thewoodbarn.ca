<?php
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('admin', [
	'uses'=>'PageController@admin',
	'as'=>'admin'
]);

// Route::get('admin/admin/import',[
// 	'uses' => 'Admin\AdminController@import',
// 	'as' => 'admin.admin.import'
// 	]);

// Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
// {





	Route::get('settings', [
		'uses'=>'SettingController@index',
		'as'=>'settings'
		]);

	Route::get('test1', [
		'uses'=>'AdminController@test1',
		'as'=>'test1'
		]);
// });