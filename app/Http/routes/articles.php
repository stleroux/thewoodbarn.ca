<?php
/*
|--------------------------------------------------------------------------
| ARTICLES ROUTES
|--------------------------------------------------------------------------
*/

// Route::get('admin/articles',[
// 	'uses'=>'Admin\ArticleController@index',
// 	'as'=>'admin.articles.index'
// ]);

// Route::get('articles/create',[
// 	'uses' => 'ArticleController@create',
// 	'as' => 'articles.create'
// ]);

// Route::post('articles',[
// 	'uses'=>'ArticleController@store',
// 	'as'=>'articles.store'
// ]);

// Route::get('admin/articles/{id}',[
// 	'uses'=>'Admin\ArticleController@show',
// 	'as'=>'admin.articles.show'
// ]);

// Route::get('articles/{id}/edit',[
// 	'uses'=>'ArticleController@edit',
// 	'as'=>'articles.edit'
// ]);

// Route::put('articles/{id}',[
// 	'uses'=>'ArticleController@update',
// 	'as'=>'articles.update'
// ]);

// Route::get('articles/{id}/delete',[
// 	'uses'=>'ArticleController@delete',
// 	'as'=>'articles.delete'
// ]);

// Route::delete('articles/{id}',[
// 	'uses'=>'ArticleController@destroy',
// 	'as'=>'articles.destroy'
// ]);

// Route::get('/articles/{id}/print', [
// 	'uses' => 'ArticleController@printArticle',
// 	'as' => 'articles.print'
// ]);

// Route::get('admin/articles/import',[
// 	'uses' => 'Admin\ArticleController@import',
// 	'as' => 'admin.articles.import'
// ]);
/*
|--------------------------------------------------------------------------
| ARTICLES ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('articles',[
	'uses'=>'ArticleController@index',
	'as'=>'articles.index'
]);

Route::get('articles/create',[
	'uses' => 'ArticleController@create',
	'as' => 'articles.create'
]);

Route::post('articles/store',[
	'uses'=>'ArticleController@store',
	'as'=>'articles.store'
]);

Route::get('articles/import',[
	'uses' => 'ArticleController@import',
	'as' => 'articles.import'
]);

Route::get('articles/{id}',[
	'uses'=>'ArticleController@show',
	'as'=>'articles.show'
]);

Route::get('articles/{id}/edit',[
	'uses'=>'ArticleController@edit',
	'as'=>'articles.edit'
]);

Route::put('articles/{id}',[
	'uses'=>'ArticleController@update',
	'as'=>'articles.update'
]);

Route::delete('articles/{id}',[
	'uses'=>'ArticleController@destroy',
	'as'=>'articles.destroy'
]);

// Route::delete('articles/{id}',[
// 	'uses'=>'ArticleController@deleteSelected',
// 	'as'=>'articles.deleteSelected'
// ]);

Route::get('articles/{id}/duplicate', [
	'uses' => 'ArticleController@duplicate',
	'as' => 'articles.duplicate'
]);

Route::get('articles/exportPDF',[
	'uses' => 'ArticleController@exportPDF',
	'as' => 'articles.exportPDF'
]);

Route::get('articles/downloadExcel/{type}',[
	'uses' => 'ArticleController@downloadExcel',
	'as' => 'articles.downloadExcel'
]);

Route::post('articles/importExcel',[
	'uses' => 'ArticleController@importExcel',
	'as' => 'articles.importExport'
]);

Route::get('/articles/{id}/print', [
	'uses' => 'ArticleController@printArticle',
	'as' => 'articles.print'
]);