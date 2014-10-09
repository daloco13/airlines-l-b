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
Route::get('/select', 'AirlinesController@select');
Route::post('/passengers', 'AirlinesController@select_flight');

//	passenger details
Route::get('/passengers','AirlinesController@details');
Route::post('/confirmation','AirlinesController@confirmation');

// confirmation
Route::get('/finale','AirlinesController@finale');






