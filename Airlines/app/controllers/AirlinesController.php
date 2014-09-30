<?php

class AirlinesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$inputDetails = Input::all();
		$airports = Airline::lists('Location');
		return View::make('content.index',['airports'=>$airports, 'input'=>$inputDetails]);
	}

	public function shit()
	{

		return Redirect::to('/')->with(['input'=>$inputDetails]);

	}

	/*
		search bro
	*/
	public function searchbro()
	{
		// $input = Input::get('borrower_id');

		$result = DB::table('flight_schedule')
				->where('FsID', '=', 1)
				->get();

		
	}

	/* 
		search flight 
	*/
	public function search()
	{
		$inputDetails = Input::all();

        $validation = Validator::make($inputDetails,Airline::setRules());

        if($validation->fails())
            return Redirect::back()->withInput()->withErrors($validation);
        else 
        { 
            $product = new Product;
            $product->prodcode = $inputDetails['prodcode'];
            $product->prodname = $inputDetails['prodname'];
            $product->prodtype = $inputDetails['prodtype'];
            $product->prodqty = $inputDetails['prodqty'];
            $product->prodprice = $inputDetails['prodprice'];
            $product->prodrlevel = $inputDetails['prodrlevel'];
            $product->prodrquant = $inputDetails['prodrquant'];

            $product->save();
        } 
  		
  		return Redirect::to('/');
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
