<?php

class AirlinesController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$results = DB::table('airport')
				   ->get();
		return View::make('content.index',['airports'=>$results]);
	}

	/*
		search bro
	*/
	public function searchbro()
	{
		// gets the inputs from index.blade.php
		$tripType 	=	Input::get('intTripType');
		$origin		=	Input::get('intFrom');
		$destination =	Input::get('intTo');
		$flightdate	=	Input::get('intDepart');
		$return		=	Input::get('intReturn');
		$adult 		=	Input::get('intAdults');
		$children	=	Input::get('intChildren');

		//input::all

        //$validation = Validator::make($inputDetails);

		// session the inputs in index.blade.php and will be used in the following page (that is, select)
		Session::put('tripType', $tripType);
		Session::put('origin', $origin);
		Session::put('destination', $destination);
		Session::put('flightdate', $flightdate);
		Session::put('return', $return);
		Session::put('adult', $adult);
		Session::put('children', $children);

		$adult = Session::get('adult');
		$children = Session::get('children');

		$total_passenger = $adult + $children;

		Session::put('total_passenger', $total_passenger);

		/*$results = "SELECT *, r.RtID, r.Origin, ap.AirportCode AS oAirportCode, ap.Location AS oLocation, ap.Country AS oCountry, r.Destination, ap1.AirportCode AS dAirportCode, ap1.Location AS dLocation, ap1.Country AS dCountry 
			FROM Flight_Schedule fs, AirFare af, Route r, Aircrafts ac, airport ap, airport ap1 

			WHERE fs.AirFare = af.AfID AND fs.AirCraft = ac.AcID AND af.Route = r.RtID AND r.Origin = ap.ApID AND  r.Destination = ap1.ApID 

			AND r.Origin = ".$_SESSION['intFrom']." AND r.Destination = ".$_SESSION['intTo']." AND ac.Capacity >= ".$_SESSION['totalPassenger']." 

			AND fs.FlightDate = '".$_SESSION['intDepart']."'
			";*/
		$results = DB::table('flight_schedule as fs')
				->join('airfare as af', 'fs.airfare', '=', 'af.AfID')
				->join('route as r', 'af.route', '=', 'r.RtID')
				->join('aircrafts as ac', 'fs.aircraft','=','ac.AcID')
				->join('airport as ap', 'ap.ApID', '=', 'r.Origin')
				->join('airport as ap1', 'ap1.ApID', '=', 'r.Destination')
				->where('fs.flightdate', '=', $flightdate)
				->where('r.Origin', '=', $origin)
				->where('r.Destination', '=', $destination)
				->select('*', 'r.RtID', 'r.Origin', 'ap.AirportCode AS oAirportCode', 'ap.Location AS oLocation', 'ap.Country AS oCountry', 'r.Destination', 'ap1.AirportCode AS dAirportCode', 'ap1.Location AS dLocation', 'ap1.Country AS dCountry')
				->get();

	    Session::put('results', $results);
		
		//return var_dump($results);
	
		if($tripType != 'oneway')
		{
			$results_rt = DB::table('flight_schedule as fs')
						->join('airfare as af', 'fs.airfare', '=', 'af.AfID')
						->join('route as r', 'af.route', '=', 'r.RtID')
						->join('aircrafts as ac', 'fs.aircraft','=','ac.AcID')
						->join('airport as ap', 'ap.ApID', '=', 'r.Origin')
						->join('airport as ap1', 'ap1.ApID', '=', 'r.Destination')
						->where('fs.flightdate', '=', $return)
						->where('r.Origin', '=', $destination)
						->where('r.Destination', '=', $origin)
						->get();

			Session::put('results_rt', $results_rt);
			return View::make('content.select')->with('results_rt', $results_rt)->with('results', $results);
		}

		return View::make('content.select')->with('results', $results);

	}

	public function select()
	{
		return View::make('content.select');

	}

	/*
		
	*/
	public function select_flight()
	{
		//  radio button for departure
		$select = Input::get('selectplaneDepart');
		//  radio button for return
		$select_2 = Input::get('selectplaneReturn');

		Session::put('select', $select);

		Session::put('select_2', $select_2);

		//  explode the value in the radio button(departure)
		$select = explode(';',Session::get('select'));
		//  explode the value in the radio button(return)
		$select_2 = explode(';',Session::get('select_2'));			
		

		//return var_dump($select);

		return View::make('content.details')->with('select', $select)->with('select_2', $select_2);
	}

	public function details()
	{
		return View::make('content.details');
	}

	/*
		
	*/
	public function finale()
	{
		$input = Input::all();

		Session::put('input', $input);

		// return var_dump($summary);

		$passengerDetails = array();

		return View::make('content.confirmation')->with('input', $input);
	}

	public function done()
	{
		return View::make('content.done');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
