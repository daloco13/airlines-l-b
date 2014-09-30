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

Route::get('/search', function()
{	
	$result = DB::table('flight_schedule')
				->where('FsID', '=', 1)
				->get();

	print_r($result);
});

// index (main page)
Route::get('/','AirlinesController@index');

Route::post('/shit', 'AirlinesController@shit');

//	select flight
Route::get('/select','AirlinesController@select');

//	guest details
Route::get('/details','AirlinesController@details');

//Route::get('/search','AirlinesController@searchbro');



