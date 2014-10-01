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
		$input = Input::get('search_field');

		$results = DB::table('flight_schedule')
				->where('FsID', '=', $input)
				->get();

		// count retrieved
		$count = 0;

		//resultss
		/*foreach($results as $key => $value)
		{
			$count++;
		}*/

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
