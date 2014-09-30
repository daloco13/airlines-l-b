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

/*Route::get('/', function()
{
	return View::make('content.index');
});*/

// index (main page)
Route::get('/','AirlinesController@index');
Route::post('/shit', 'AirlinesController@shit');

//	
Route::get('/select','AirlinesController@select');

