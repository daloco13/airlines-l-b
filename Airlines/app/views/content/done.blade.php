@extends('layout.master')

@section('content')
<div class="container">

	
	<?php 

		$select = Session::get('select');

		$adult = Session::get('adult');

		$children = Session::get('children');

		$input = Session::get('input');

	?>

	Thank you {{ $input["Title"] }} {{ $input["LName"] }}, {{ $input["FName"] }}

	of {{ $input["country"] }} , {{ $input["streetaddress"] }}  , {{ $input["city"] }}.

	<br />
	You have successfully booked for this flight:
	<div class="col-md-12">

		<div class="col-md-12">
			<div class="col-md-4 panel panel-default">
					<h5 class='summary-heading panel-heading'>Trip Summary</h5>
					<h6 class='summary-title'>Departure</h6>
					<span>Flight:</span>&nbsp;&nbsp;<span id='oFlight'> {{ Session::get('summary_0') }} </span><br />
					<span>From:</span>&nbsp;&nbsp;<span id='oDepart'> {{ Session::get('origin') }} </span><br />
					<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'> {{ Session::get('summary_2') }} </span><br />
					<span>To:</span>&nbsp;&nbsp;<span id='oArrive'> {{ Session::get('destination') }}  </span><br />
					<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'> {{ Session::get('summary_4') }} </span><br />
					<span>Total:</span>&nbsp;&nbsp; {{ Session::get('fck') }}<span id='oFare'>  </span><br />


					@if(Session::get('tripType') != 'oneway') 
					<!-- 	<div class="col-md-4"> -->
					<h6 class='summary-title'>Return</h6>
					<span>Flight:</span>&nbsp;&nbsp;<span id='dFlight'></span><br />
					<span>From:</span>&nbsp;&nbsp;<span id='dDepart'></span><br />
					<span>Departure:</span>&nbsp;&nbsp;<span id='dDeparture'></span><br />
					<span>To:</span>&nbsp;&nbsp;<span id='dArrive'></span><br />
					<span>Arrival:</span>&nbsp;&nbsp;<span id='dArrival'></span><br />
					<div class="summary-divider"></div>
					<!-- 	</div> -->
					@endif


					<span>Total Passengers: <span class='summary-right'>{{ Session::get('total_passenger'); }}</span></span>
					<div class="<?php if(Session::get('adult') <= 0) echo "hide"; ?>"><span class='summary-name'>Adult x <span id="intAdult">{{ Session::get('adult'); }}</span></span><span class='summary-right'><span id="adultDep"> &nbsp; {{ Session::get('fck') }}</span> Php(Dep) 
						<?php if(Session::get('tripType') != 'oneway') echo ' + <span id="adultRet">0</span> Php(Ret)'; ?></span></div>
							<div class="<?php if(Session::get('children') <= 0) echo "hide"; ?>"><span class='summary-name'>Child (2-11) x <span id="intChild">{{ Session::get('children'); }}</span></span><span class='summary-right'><span id="childDep"> {{ $children }}  </span> Php(Dep) 

								<?php if(Session::get('tripType') != 'oneway') echo '+ <span id="childRet">0</span> Php(Ret)'; ?></span></div>
									<div class="summary-divider"></div>
									<h6 class='summary-heading'>Total: <span class='summary-right'><span id="total"></span> {{ Session::get('fck') }} Php</span></h6>
								</div>
		</div>
		{{ link_to('/','Search Flight Again?') }}
	</div>


</div>
@endsection