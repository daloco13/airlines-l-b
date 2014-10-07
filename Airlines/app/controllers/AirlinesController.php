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
				   ->select('Location')
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


		if($tripType != 'oneway')
		{
			$result_rt =  DB::table('flight_schedule')
			    		->join('aircrafts', 'flight_schedule.aircraft','=','aircrafts.AcID')
			    		->join('airfare', 'flight_schedule.airfare', '=', 'airfare.AfID')
			    		->join('route', 'airfare.route', '=', 'route.RtID')
						->join('airport', 'airport.ApID', '=', 'route.Origin')
			    		// ->select('airport.Location', 'flight_schedule.flightdate', 'flight_schedule.departure', 'flight_schedule.arrival', 'aircrafts.AcName', 'airfare.fare')

			    		//->select('route.Origin', 'route.Destination', 'flight_schedule.departure', 'flight_schedule.arrival', 'aircrafts.AcName', 'airfare.fare')
			    		->where('flight_schedule.flightdate', '=', $flightdate)
			    		->orWhere(function($query) use ($origin, $destination)
			            {
			                $query->where('airport.Location', '=', $origin)
			                		->where('airport.Location', '=', $destination);
			            })
			       		->get();
						//where('flight_schedule.return', '=', $return)

			Session::put('results_rt', $results_rt);
			return View::make('content.select')->with('results_rt', $results_rt);
		}

		else
		{
			$results =  DB::table('flight_schedule')
		        		->join('aircrafts', 'flight_schedule.aircraft','=','aircrafts.AcID')
		        		->join('airfare', 'flight_schedule.airfare', '=', 'airfare.AfID')
		        		->join('route', 'airfare.route', '=', 'route.RtID')
						->join('airport', 'airport.ApID', '=', 'route.Origin')
		        		// ->select('airport.Location', 'flight_schedule.flightdate', 'flight_schedule.departure', 'flight_schedule.arrival', 'aircrafts.AcName', 'airfare.fare')
		        		->select('route.Origin', 'route.Destination', 'airport.Location', 'airport.Location', 'flight_schedule.departure', 'flight_schedule.arrival', 'aircrafts.AcName', 'airfare.fare')
		        		->where('flight_schedule.flightdate', '=', $flightdate)
		        		->orWhere(function($query) use ($origin, $destination)
			            {
			                $query->where('airport.Location', '=', $origin)
			                		->where('airport.Location', '=', $destination);
			            })
		           		->get();

		    Session::put('results', $results);
			return View::make('content.select')->with('results', $results);
			// return var_dump($results[0]);
		}
	}

	public function select()
	{
		return View::make('content.select');

	}

	/*public function continue()
	{

	}*/

	public function details()
	{
		return View::make('content.details');
	}

	public function confirmation()
	{
		return View::make('content.confirmation');
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
