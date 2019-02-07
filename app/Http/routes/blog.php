<?php
Route::get('blog/{slug}', [
	'uses'=>'BlogController@getSingle',
	'as'=>'blog.single'])
	->where('slug', '[\w\d\-\_]+')
;

Route::get('blog', [
	'uses'=>'BlogController@getIndex',
	'as'=>'blog.index'
]);

Route::get('blog/viewImage/{id}', ['uses'=>'BlogController@viewImage', 'as'=>'blog.viewImage']);
Route::get('blog/{year}/{month}', ['uses'=>'BlogController@archive', 'as'=>'blog.archive']);