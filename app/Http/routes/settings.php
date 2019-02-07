<?php
/*
|--------------------------------------------------------------------------
| Admin routes
| The routes are needed for the left menu in the Control Panel to work
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
	// Route::get('settings/{id}/show', [
	// 	'uses' => 'SettingController@show',
	// 	'as' => 'settings.show',
	// 	'middleware' => ['permission:admin|settings_list'],
	// 	]);

	Route::get('settings/create', [
		'uses' => 'SettingController@create',
		'as' => 'settings.create'
		]);

	Route::post('settings', [
		'uses' => 'SettingController@store',
		'as' => 'settings.store'
		]);

	Route::get('/settings/{id}/edit', [
		'uses' => 'SettingController@edit',
		'as' => 'settings.edit'
		]);

	Route::put('settings/{id}', [
		'uses' => 'SettingController@update',
		'as' => 'settings.update'
		]);

	Route::delete('settings/{id}/delete', [
	 	'uses' => 'SettingController@destroy',
	 	'as' => 'settings.delete'
	 	]);
});