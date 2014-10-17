@extends('layout.master')

@section('content')
<div class="container">

	
	<?php 

		$select = Session::get('select');

		$select_2 = Session::get('select_2');

		$adult = Session::get('adult');

		$children = Session::get('children');

		$input = Session::get('input');

		$results = Session::get('results');

		$flightdate = Session::get('flightdate');

		$return = Session::get('return');

	?>

	
	<div class="col-md-12">

		<div class="col-md-12">
			<div class="demo-headline">
				<div class="logo">{{ HTML::image('img/logo-big.png', $alt="logo-big", $attributes = array()) }}</div>
			</div> <!-- /demo-headline -->
			
			<div class="col-md-2"></div>
			<div class="col-md-8 panel panel-default">
					<h5 class='summary-heading panel-heading'>Flight Details</h5>					
					
					Booking Date: <b>{{ date('F, d Y (l)') }}</b> 

					<br /><br />

					Thank you {{ $input["Title"] }} {{ $input["LName"] }}, {{ $input["FName"] }}

					of {{ $input["streetaddress"] }}  , {{ $input["city"] }}.

					<br />

					You have successfully booked for this flight: 


					<h6 class='summary-title'>Departure</h6>
					<span>Flight Date:</span>&nbsp;&nbsp;<span id='oFlight'> {{ date('F, d Y', strtotime($flightdate)) }} </span><br />
					<span>Flight:</span>&nbsp;&nbsp;<span id='oFlight'> {{ $select[0] }} </span><br />
					<span>From:</span>&nbsp;&nbsp;<span id='oDepart'> {{ $select[1] }} </span><br />
					<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'> {{ $select[2] }} </span><br />
					<span>To:</span>&nbsp;&nbsp;<span id='oArrive'> {{ $select[3] }}  </span><br />
					<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'> {{ $select[4] }} </span><br />
					


					@if(Session::get('tripType') != 'oneway') 
					<!-- 	<div class="col-md-4"> -->
					<h6 class='summary-title'>Return</h6>
					<span>Return Date:</span>&nbsp;&nbsp;<span id='oFlight'> {{ date('F, d Y', strtotime($return)) }} </span><br />
					<span>Flight:</span>&nbsp;&nbsp;{{ $select_2[0] }}<span id='dFlight'></span><br />
					<span>From:</span>&nbsp;&nbsp;{{ $select_2[1] }}<span id='dDepart'></span><br />
					<span>Departure:</span>&nbsp;&nbsp;{{ $select_2[2] }}<span id='dDeparture'></span><br />
					<span>To:</span>&nbsp;&nbsp;{{ $select_2[3] }}<span id='dArrive'></span><br />
					<span>Arrival:</span>&nbsp;&nbsp;{{ $select_2[4] }}<span id='dArrival'></span><br />
					<div class="summary-divider"></div>
					<!-- 	</div> -->
					@endif


					<span>Total Passengers: <span class='summary-right'>{{ Session::get('total_passenger'); }}</span></span>
					<div class="<?php if(Session::get('adult') <= 0) echo "hide"; ?>"><span class='summary-name'>Adult x <span id="intAdult">{{ Session::get('adult'); }}</span></span><span class='summary-right'><span id="adultDep"> &nbsp; {{ Session::get('done_total') }}</span> Php(Dep) 
						<?php if(Session::get('tripType') != 'oneway') echo ' + <span id="adultRet"> '.Session::get('total2').' </span> Php(Ret)'; ?></span></div>
							<div class="<?php if(Session::get('children') <= 0) echo "hide"; ?>"><span class='summary-name'>Child (2-11) x <span id="intChild">{{ Session::get('children'); }}</span></span><span class='summary-right'><span id="childDep"> {{ $children }}  </span> Php(Dep) 

								<?php if(Session::get('tripType') != 'oneway') echo '+ <span id="childRet">0</span> Php(Ret)'; ?></span></div>
									<div class="summary-divider"></div>
									<h6 class='summary-heading'>Total: <span class='summary-right'><span id="total"></span> @if(Session::get('tripType')!='oneway') {{ Session::get('total_rt') }} @else {{ Session::get('done_total') }} @endif Php</span></h6>
								</div>


		</div>
			<div class="col-md-2"></div>
			<div class="col-md-8">{{ link_to('/','Search Flight Again?') }}</div>
	</div>


</div>
@endsection