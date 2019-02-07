<?php

Route::get('shop/index/{key}',[
	'uses' => 'CartController@getIndex',
	'as' => 'shop.index'
]);

Route::get('/add-to-cart/{id}', [
	'uses' => 'CartController@getAddToCart',
	'as' => 'shop.addToCart'
]);

Route::get('/reduce/{id}', [
	'uses' => 'CartController@getReduceByOne',
	'as' => 'shop.reduceByOne'
]);

Route::get('/increase/{id}', [
	'uses' => 'CartController@getIncreaseByOne',
	'as' => 'shop.increaseByOne'
]);

Route::get('/remove/{id}', [
	'uses' => 'CartController@getRemoveItem',
	'as' => 'shop.removeItem'
]);

Route::get('/clearCart', [
	'uses' => 'CartController@getClearCart',
	'as' => 'shop.clearCart'
]);

Route::get('/shopping-cart', [
	'uses' => 'CartController@getCart',
	'as' => 'shop.shoppingCart'
]);

Route::get('/checkout', [
	'uses' => 'CartController@getCheckout',
	'as' => 'checkout',
	'middleware' => 'auth'
]);

Route::post('/checkout', [
	'uses' => 'CartController@postCheckout',
	'as' => 'checkout',
	'middleware' => 'auth'
]);