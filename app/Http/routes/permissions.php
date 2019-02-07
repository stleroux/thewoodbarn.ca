<?php
/*
|--------------------------------------------------------------------------
| PERMISSIONS ROUTES
|--------------------------------------------------------------------------
*/
Route::get('permissions',[
	'uses'=>'PermissionController@index',
	'as'=>'permissions.index'
	]);

Route::get('permissions/create',[
	'uses'=>'PermissionController@create',
	'as'=>'permissions.create'
	]);

/*
|--------------------------------------------------------------------------
| PERMISSIONS ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('admin/permissions',[
	'uses'=>'Admin\PermissionController@index',
	'as'=>'admin.permissions.index'
	]);

Route::get('admin/permissions/import',[
	'uses' => 'Admin\PermissionController@import',
	'as' => 'admin.permissions.import'
	]);

Route::get('admin/permissions/create',[
	'uses'=>'Admin\PermissionController@create',
	'as'=>'admin.permissions.create'
	]);

Route::post('admin/permissions',[
	'uses'=>'Admin\PermissionController@store',
	'as'=>'admin.permissions.store'
	]);

Route::get('admin/permissions/{id}/edit',[
	'uses'=>'Admin\PermissionController@edit',
	'as'=>'admin.permissions.edit'
	]);

Route::put('admin/permissions/{id}',[
	'uses'=>'Admin\PermissionController@update',
	'as'=>'admin.permissions.update'
	]);

Route::get('admin/permissions/{id}/delete',[
	'uses'=>'Admin\PermissionController@delete',
	'as'=>'admin.permissions.delete'
	]);

Route::delete('admin/permissions/{id}',[
	'uses'=>'Admin\PermissionController@destroy',
	'as'=>'admin.permissions.destroy'
	]);

Route::get('admin/permissions/{id}/duplicate', [
    'uses' => 'Admin\PermissionController@duplicate',
    'as' => 'admin.permissions.duplicate'
    ]);

Route::get('admin/permissions/{id}/makeAdmin', [
    'uses' => 'Admin\PermissionController@makeAdmin',
    'as' => 'admin.permissions.makeAdmin'
    ]);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
	Route::get('permissions/exportPDF',[
		'uses' => 'PermissionController@exportPDF',
		'as' => 'permissions.exportPDF'
		]);

	Route::get('permissions/downloadExcel/{type}',[
		'uses' => 'PermissionController@downloadExcel',
		'as' => 'permissions.downloadExcel'
		]);

	Route::post('permissions/importExcel',[
		'uses' => 'PermissionController@importExcel',
		'as' => 'permissions.importExport'
		]);
});