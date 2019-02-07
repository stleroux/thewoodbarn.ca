<?php
/*
|--------------------------------------------------------------------------
| COMMENTS ROUTES
|--------------------------------------------------------------------------
*/
Route::post('comments/{post_id}', [
	'uses' => 'CommentController@store',
	'as' => 'comments.store',
]);

/*
|--------------------------------------------------------------------------
| COMMENTS ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('admin/comments/{id}/edit', [
	'uses' => 'Admin\CommentController@edit',
	'as' => 'admin.comments.edit',
]);

Route::put('admin/comments/{id}', [
	'uses' => 'Admin\CommentController@update',
	'as' => 'admin.comments.update',
]);

Route::delete('admin/comments/{id}', [
	'uses' => 'Admin\CommentController@destroy',
	'as' => 'admin.comments.destroy',
]);

Route::get('admin/comments/{id}/delete', [
	'uses' => 'Admin\CommentController@delete',
	'as' => 'admin.comments.delete',
]);