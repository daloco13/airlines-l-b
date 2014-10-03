<?php

class AirlinesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$airports = Airline::all();
		return View::make('content.index',['airports'=>$airports]);
	}

	/*
		search bro
	*/
	public function searchbro()
	{
		// inputs for search
		$tripType 	=	Input::get('intTripType');
		$origin		=	Input::get('intFrom');
		$destination =	Input::get('intTo');
		$flightdate	=	Input::get('intDepart');
		$return		=	Input::get('intReturn');
		$adult 		=	Input::get('intAdults');
		$children	=	Input::get('intChildren');

		// session the inputs
		Session::put('tripType', $tripType);
		Session::put('origin', $origin);
		Session::put('destination', $destination);
		Session::put('flightdate', $flightdate);
		Session::put('return', $return);
		Session::put('adult', $adult);
		Session::put('children', $children);

		$results =  DB::table('flight_schedule')
	        		->join('aircrafts', 'flight_schedule.aircraft','=','aircrafts.AcID')
	        		->join('airfare', 'flight_schedule.airfare', '=', 'airfare.AfID')
	        		->join('route', 'airfare.route', '=', 'route.RtID')
					->join('airport', 'airport.ApID', '=', 'route.Origin')
	        		->select('airport.location', 'flight_schedule.flightdate', 'flight_schedule.departure', 'flight_schedule.arrival', 'aircrafts.AcName', 'airfare.fare')
	        		->where('flight_schedule.flightdate', '=', $flightdate)
	        		->orWhere(function($query) use ($origin, $destination)
		            {
		                $query->where('airport.location', '=', $origin)
		                      ->where('airport.location', '=', $destination);
		            })
	           		->get();

		return View::make('content.select')->with('results', $results);
	}

	public function select()
	{
		// $productInfo = Flight::find($flight);
		return View::make('content.select');

	}

	public function details()
	{
		return View::make('content.details');
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
