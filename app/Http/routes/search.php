<?php
/*
|=================================================================|
| Search                                                          |
|=================================================================|
*/
Route::get('search/posts', ['uses' => 'SearchController@getPosts', 'as' => 'search.posts']);
Route::get('search/recipes', ['uses' => 'SearchController@getRecipes', 'as' => 'search.recipes']);
Route::get('search/articles', ['uses' => 'SearchController@getArticles', 'as' => 'search.articles']);

