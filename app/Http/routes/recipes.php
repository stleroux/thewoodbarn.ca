<?php
/*
|--------------------------------------------------------------------------
| RECIPES ROUTES
|--------------------------------------------------------------------------
*/


// No need for permissions here as any visitor should be able to see the recipes list
Route::get('/recipes/index/{key}', [
	'uses' => 'RecipeController@index',
	'as' => 'recipes.index'
	]);

Route::get('/recipes/create', [
	'uses' => 'RecipeController@create',
	'as' => 'recipes.create'
	]);

Route::post('/recipes/store', [
	'uses' => 'RecipeController@store',
	'as' => 'recipes.store'
	]);

// No need for permissions here as any visitor should be able to see the recipes list
Route::get('/recipes/{id}/show', [
	'uses' => 'RecipeController@show',
	'as' => 'recipes.show'
	]);

Route::get('/recipes/{id}/edit', [
	'uses' => 'RecipeController@edit',
	'as' => 'recipes.edit'
	]);

Route::put('/recipes/{id}', [
	'uses' => 'RecipeController@update',
	'as' => 'recipes.update'
	]);

Route::get('/recipes/{id}/delete', [
 	'uses' => 'RecipeController@delete',
 	'as' => 'recipes.delete'
 	]);

Route::delete('recipes/{id}', [
 	'uses' => 'RecipeController@destroy',
 	'as' => 'recipes.destroy'
 	]);

// No need for permissions here as any visitor should be able to see the recipe's image
Route::get('recipes/{id}/viewImage', [
	'uses'=>'RecipeController@viewImage',
	'as'=>'recipes.viewImage',
	]);

Route::get('/recipes/myRecipes/{key}', [
	'uses' => 'RecipeController@myRecipes',
	'as' => 'recipes.myRecipes'
	]);

Route::get('recipes/myFavorites/{key}', [
	'uses' => 'RecipeController@myFavorites',
	'as' => 'recipes.myFavorites',
	]);

Route::get('recipes/published/{key}', [
	'uses' => 'RecipeController@published',
	'as' => 'recipes.published',
	]);

Route::get('recipes/nonPublished/{key}', [
	'uses' => 'RecipeController@nonPublished',
	'as' => 'recipes.nonPublished',
	]);

Route::get('recipes/{id}/addfavorite', [
	'uses' => 'RecipeController@addfavorite',
	'as' => 'recipes.addfavorite'
	]);

Route::get('recipes/{id}/removefavorite', [
	'uses' => 'RecipeController@removefavorite',
	'as' => 'recipes.removefavorite'
	]);

Route::delete('/recipes/{id}/deleteImage', [
	'uses' => 'RecipeController@deleteImage',
	'as' => 'recipes.deleteImage'
	]);

Route::get('/recipes/{id}/print', [
	'uses' => 'RecipeController@printRecipe',
	'as' => 'recipes.print'
	]);

// No need for permissions here as any visitor should be able to see the recipe's author information
Route::get('/recipes/{id}/showUser', [
	'uses' => 'RecipeController@showUser',
	'as' => 'recipes.showUser'
	]);

Route::get('recipes/{id}/makeprivate', [
	'uses' => 'RecipeController@makeprivate',
	'as' => 'recipes.makeprivate'
	]);

Route::get('recipes/{id}/removeprivate', [
	'uses' => 'RecipeController@removeprivate',
	'as' => 'recipes.removeprivate'
	]);

Route::get('recipes/{id}/publish', [
	'uses' => 'RecipeController@publish',
	'as' => 'recipes.publish'
	]);

Route::get('recipes/{id}/unpublish', [
	'uses' => 'RecipeController@unpublish',
	'as' => 'recipes.unpublish'
	]);

Route::get('recipes/{year}/{month}', [
	'uses'=>'RecipeController@archive',
	'as'=>'recipes.archive'
	]);




/*
|--------------------------------------------------------------------------
| RECIPES ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('admin/recipes', [
	'uses'=>'Admin\RecipeController@index',
	'as'=>'admin.recipes.index'
	]);

Route::get('admin/recipes/create', [
	'uses' => 'Admin\RecipeController@create',
	'as' => 'admin.recipes.create'
	]);

Route::post('admin/recipes/store', [
	'uses' => 'Admin\RecipeController@store',
	'as' => 'admin.recipes.store'
	]);

Route::get('admin/recipes/{id}/show', [
	'uses' => 'Admin\RecipeController@show',
	'as' => 'admin.recipes.show'
	]);

Route::get('admin/recipes/{id}/edit', [
	'uses' => 'Admin\RecipeController@edit',
	'as' => 'admin.recipes.edit'
	]);

Route::put('admin/recipes/{id}', [
	'uses' => 'Admin\RecipeController@update',
	'as' => 'admin.recipes.update'
	]);

Route::get('admin/recipes/{id}/delete', [
 	'uses' => 'Admin\RecipeController@delete',
 	'as' => 'admin.recipes.delete'
 	]);

Route::delete('admin/recipes/{id}', [
 	'uses' => 'Admin\RecipeController@destroy',
 	'as' => 'admin.recipes.destroy'
 	]);

Route::get('admin/recipes/import',[
	'uses' => 'Admin\RecipeController@import',
	'as' => 'admin.recipes.import'
	]);

Route::get('admin/recipes/downloadExcel/{type}',[
	'uses' => 'Admin\RecipeController@downloadExcel',
	'as' => 'admin.recipes.downloadExcel'
	]);

Route::post('admin/recipes/importExcel',[
	'uses' => 'Admin\RecipeController@importExcel',
	'as' => 'admin.recipes.importExport'
	]);

Route::get('admin/recipes/exportPDF',[
	'uses' => 'Admin\RecipeController@exportPDF',
	'as' => 'admin.recipes.exportPDF'
	]);
