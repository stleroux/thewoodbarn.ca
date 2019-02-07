<?php
/*
|=================================================================|
| User Profile                                                    |
|=================================================================|
*/
Route::get('profile',[
	'uses'=>'ProfileController@index',
	'as'=>'profile.index'
	]);

Route::get('/profile/{id}/edit', [
	'uses' => 'ProfileController@edit',
	'as' => 'profile.edit'
	]);

Route::put('/profile/{id}', [
	'uses' => 'ProfileController@update',
	'as' => 'profile.update'
	]);

Route::get('/profile/{id}/show', [
	'uses' => 'ProfileController@show',
	'as' => 'profile.show'
	]);

Route::get('/profile/{id}/showUser', [
	'uses' => 'ProfileController@showUser',
	'as' => 'profile.showUser'
	]);

Route::get('/profile/{id}/changePassword', [
	'uses' => 'ProfileController@changePassword',
    'as' => 'profile.changePassword'
 ]);

Route::post('/profile/{id}/updatePassword', [
	'uses' => 'ProfileController@updatePassword',
    'as' => 'profile.updatePassword'
 ]);

Route::get('/profile/{id}/deleteImage', [
	'uses' => 'ProfileController@deleteImage',
	'as' => 'profile.deleteImage'
	]);

