<?php

Route::get('items',[
	'uses'=>'ItemController@index',
	'as'=>'items.index'
	]);

Route::get('items/create',[
	'uses'=>'ItemController@create',
	'as'=>'items.create'
	]);

Route::post('items',[
	'uses'=>'ItemController@store',
	'as'=>'items.store'
	]);

Route::get('items/import',[
	'uses' => 'ItemController@import',
	'as' => 'items.import'
	]);

Route::get('items/trashed',[
	'uses' => 'ItemController@trashed',
	'as' => 'items.trashed'
	]);

Route::post('items/massRestore',[
	'uses'=>'ItemController@massRestore',
	'as'=>'items.massRestore'
	]);

Route::get('items/{id}',[
	'uses'=>'ItemController@show',
	'as'=>'items.show'
	]);

Route::get('items/{id}/edit',[
	'uses'=>'ItemController@edit',
	'as'=>'items.edit'
	]);

Route::put('items/{id}',[
	'uses'=>'ItemController@update',
	'as'=>'items.update'
	]);

Route::get('items/{id}/restore',[
	'uses'=>'ItemController@restore',
	'as'=>'items.restore'
	]);

Route::get('items/{id}/delete',[
	'uses'=>'ItemController@delete',
	'as'=>'items.delete'
	]);

Route::delete('items/massDestroy',[
	'uses'=>'ItemController@massDestroy',
	'as'=>'items.massDestroy'
	]);

Route::delete('items/massDestroyTrashed',[
	'uses'=>'ItemController@massDestroyTrashed',
	'as'=>'items.massDestroyTrashed'
	]);

Route::delete('items/{id}/deleteTrashed',[
	'uses'=>'ItemController@destroyTrashed',
	'as'=>'items.destroyTrashed'
	]);

Route::delete('items/{id}',[
	'uses'=>'ItemController@destroy',
	'as'=>'items.destroy'
	]);

Route::get('items/{id}/duplicate', [
    'uses' => 'ItemController@duplicate',
    'as' => 'items.duplicate'
    ]);

Route::get('items/downloadExcel/{type}',[
	'uses' => 'ItemController@downloadExcel',
	'as' => 'items.downloadExcel'
	]);

Route::post('items/importExcel',[
	'uses' => 'ItemController@importExcel',
	'as' => 'items.importExport'
	]);

Route::get('items/exportPDF',[
	'uses' => 'ItemController@exportPDF',
	'as' => 'items.exportPDF'
	]);
