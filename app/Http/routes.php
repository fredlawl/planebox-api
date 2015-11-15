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

Route::resource('profile', 'ProfileController');

//Route::resource('data', 'DataController');
Route::get('data', [
	'middleware' => 'simpleauth',
	'uses' => 'DataController@index'
]);

Route::post('data', [
	'uses' => 'DataController@store'
]);



Route::controllers([
	'auth' => 'AuthController'
]);
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController'
//]);
