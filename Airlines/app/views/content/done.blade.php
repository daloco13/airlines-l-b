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
					


					@if(Session::get('tripType') != 'oneway') 
					<!-- 	<div class="col-md-4"> -->
					<h6 class='summary-title'>Return</h6>
					<span>Flight:</span>&nbsp;&nbsp;{{ Session::get('summary2_0') }}<span id='dFlight'></span><br />
					<span>From:</span>&nbsp;&nbsp;{{ Session::get('destination') }}<span id='dDepart'></span><br />
					<span>Departure:</span>&nbsp;&nbsp;{{ Session::get('summary2_2') }}<span id='dDeparture'></span><br />
					<span>To:</span>&nbsp;&nbsp;{{ Session::get('origin') }}<span id='dArrive'></span><br />
					<span>Arrival:</span>&nbsp;&nbsp;{{ Session::get('summary2_4') }}<span id='dArrival'></span><br />
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
		{{ link_to('/','Search Flight Again?') }}
	</div>


</div>
@endsection