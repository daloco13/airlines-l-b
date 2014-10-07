<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// index
Route::get('/','AirlinesController@index');
Route::post('/select', 'AirlinesController@searchbro');

//	select flight
Route::get('/','AirlinesController@');


//	guest details
Route::get('/details','AirlinesController@details');





