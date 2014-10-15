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
Route::post('/finale','AirlinesController@finale');

// confirmation
Route::get('/finale','AirlinesController@finale');
Route::post('/done','AirlinesController@done');



// add aircrafts
Route::post('add', function()
{
	  DB::table('aircrafts')->insert(array(
		   		array('AcID' => '1', 'AcName' => 'ADR-001'),
		    	array('AcID' => '2', 'AcName' => 'IAN-002'),
	    		array('AcID' => '3', 'AcName' => 'DAV-003'),
	    		array('AcID' => '4', 'AcName' => 'SHA-004'),
	    		array('AcID' => '5', 'AcName' => 'NEI-005'),
	    		array('AcID' => '6', 'AcName' => 'JON-006'),
	    		array('AcID' => '7', 'AcName' => 'NAS-007'),
	    		array('AcID' => '8', 'AcName' => 'WTF-008'),
	    		array('AcID' => '9', 'AcName' => 'CEW-009'),
	    	)
	);
});

// add airports
Route::post('add_2', function()
{
	  DB::table('airports')->insert(array(
	   		 array('ApID' => '1', 'AirportCode' => 'CEB', 'Location' => 'Cebu', 'Country' => 'Philippines'),
	   		 array('ApID' => '2', 'AirportCode' => 'MET', 'Location' => 'Metro Manila', 'Country' => 'Philippines'),
	   		 array('ApID' => '3', 'AirportCode' => 'CAM', 'Location' => 'Camiguin', 'Country' => 'Philippines'),
	   		 array('ApID' => '4', 'AirportCode' => 'BOH', 'Location' => 'Bohol', 'Country' => 'Philippines'),
	   		 array('ApID' => '5', 'AirportCode' => 'MIN', 'Location' => 'Mindanao', 'Country' => 'Philippines'),
	   		 )
	);
});

// add airfare
Route::post('add_3', function()
{
	  DB::table('airfare')->insert(array(
	   		 array('AfID' => '1', 'Route' => 1, 'Fare' => '1100', 'Country' => 'Philippines'),
	   		 array('AfID' => '2', 'Route' => 4, 'Fare' => '1200', 'Country' => 'Philippines'),
	   		 array('AfID' => '3', 'Route' => 1, 'Fare' => '1300', 'Country' => 'Philippines'),
	   		 array('AfID' => '4', 'Route' => 3, 'Fare' => '1400', 'Country' => 'Philippines'),
	   		 array('AfID' => '5', 'Route' => 1, 'Fare' => '1500', 'Country' => 'Philippines'),
	   		 array('AfID' => '6', 'Route' => 2, 'Fare' => '1100', 'Country' => 'Philippines'),
	   		 array('AfID' => '7', 'Route' => 5, 'Fare' => '1200', 'Country' => 'Philippines'),
	   		 array('AfID' => '8', 'Route' => 2, 'Fare' => '1300', 'Country' => 'Philippines'),
	   		 array('AfID' => '9', 'Route' => 4, 'Fare' => '1400', 'Country' => 'Philippines'),
	   		 array('AfID' => '10', 'Route' => 2, 'Fare' => '1500', 'Country' => 'Philippines'),
	   		 )
	);
});


// add route
Route::post('add_4', function()
{
	  DB::table('route')->insert(array(
	   			array('RtID' => 1, 'Origin' => 1, 'Destination' => 2),
	    		array('RtID' => 2, 'Origin' => 2, 'Destination' => 1),
	    		array('RtID' => 3, 'Origin' => 3, 'Destination' => 4),
	    		array('RtID' => 4, 'Origin' => 5, 'Destination' => 5),
	    		array('RtID' => 5, 'Origin' => 5, 'Destination' => 3),
	    		)
	);
});


// add flight_schedule
Route::post('add_5', function()
{
	  DB::table('flight_schedule')->insert(array(
	   		 	array('FsID' => 1, 'FlightDate' => '2014-10-13', 'Departure' => '08:00:00.000000', 'Arrival' => '09:00:00.000000', 'Aircraft' => 1, 'Airfare' => 1),
	    		array('FsID' => 2, 'FlightDate' => '2014-10-13', 'Departure' => '09:00:00.000000', 'Arrival' => '10:00:00.000000', 'Aircraft' => 2, 'Airfare' => 2),
	    		array('FsID' => 3, 'FlightDate' => '2014-10-13', 'Departure' => '10:00:00.000000', 'Arrival' => '11:00:00.000000', 'Aircraft' => 3, 'Airfare' => 3),
	    		array('FsID' => 4, 'FlightDate' => '2014-10-13', 'Departure' => '11:00:00.000000', 'Arrival' => '12:00:00.000000', 'Aircraft' => 4, 'Airfare' => 4),
	    		array('FsID' => 5, 'FlightDate' => '2014-10-13', 'Departure' => '12:00:00.000000', 'Arrival' => '13:00:00.000000', 'Aircraft' => 5, 'Airfare' => 5),
	    		array('FsID' => 6, 'FlightDate' => '2014-10-13', 'Departure' => '13:00:00.000000', 'Arrival' => '14:00:00.000000', 'Aircraft' => 6, 'Airfare' => 6),
	    		array('FsID' => 7, 'FlightDate' => '2014-10-13', 'Departure' => '14:00:00.000000', 'Arrival' => '15:00:00.000000', 'Aircraft' => 7, 'Airfare' => 7),
	    		array('FsID' => 8, 'FlightDate' => '2014-10-13', 'Departure' => '15:00:00.000000', 'Arrival' => '16:00:00.000000', 'Aircraft' => 8, 'Airfare' => 8),
	    		array('FsID' => 9, 'FlightDate' => '2014-10-13', 'Departure' => '16:00:00.000000', 'Arrival' => '17:00:00.000000', 'Aircraft' => 9, 'Airfare' => 9),
	    		array('FsID' => 10, 'FlightDate' => '2014-10-13', 'Departure' => '17:00:00.000000', 'Arrival' => '18:00:00.000000', 'Aircraft' => 10, 'Airfare' => 10),
	    		)
	);
});



