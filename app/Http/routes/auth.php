<?php
// Authentication routes
Route::get('auth/login', ['uses'=>'Auth\AuthController@getLogin', 'as'=>'login']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['uses'=>'Auth\AuthController@getLogout', 'as'=>'logout']);


// Registration routes
Route::get('auth/register', ['uses'=>'Auth\AuthController@getRegister', 'as'=>'register']);
Route::post('auth/register', 'Auth\AuthController@postRegister');