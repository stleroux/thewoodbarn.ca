<?php
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('audits', [
	'uses'=>'AuditController@index',
	'as'=>'audits.index'
]);
