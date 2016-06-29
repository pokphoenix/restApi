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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'api','middleware' => []], function () {
    Route::post('authenticate','AuthController@authenticate');
});

Route::group(['prefix' => 'api','middleware' => ['jwt.auth']], function () {
    Route::get('auth','AuthController@index');
    Route::get('auths','AuthController@show');
});

