<?php
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('orders', [
	'uses'=>'OrderController@index',
	'as'=>'orders.index'
]);
