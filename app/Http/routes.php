<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Include all files from app\Http\routes\ folder
foreach ( File::allFiles(__DIR__.'/routes') as $partial )
{
    require $partial->getPathname();
}

// Route::get('/', function () {
//     return view('welcome');
// });

Route::auth();

// Template file
Route::get('template', [
	'uses'=>'pageController@template',
	'as'=>'template'
	]);

Route::get('contact', [
	'uses' => 'PageController@getContact',
	'as' => 'contact'
	]);

Route::post('contact', 'PageController@postContact'); //sending the contact info

Route::get('about', [
	'uses' => 'PageController@getAbout',
	'as' => 'about'
	]);

Route::get('/', [
	'uses' => 'PageController@getIndex',
	'as' => 'home'
	]);

Route::get('new_reg', [
	'uses' => 'PageController@getNewReg',
	'as' => 'new_reg'
	]);

Route::get('dashboard', [
	'uses' => 'PageController@getDashboard',
	'as' => 'dashboard',
	'middleware' => 'auth'
	]);

// Test file
Route::get('test', [
	'uses'=>'pageController@test',
	'as'=>'test'
	]);

// used by vendor/rap2hpoutre/logviewer
Route::get('logs', [
	'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
	'as' => 'logs'
	]);

