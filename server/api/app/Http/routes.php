<?php

Route::get(         '/api/login', 									'LoginController@index');
Route::get(			'/api/ping', 									'LoginController@ping');
Route::get(			'/api/logout', 									'LoginController@logout');

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

Route::get('/', function () {
    return view('welcome');
});
