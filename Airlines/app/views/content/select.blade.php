@extends('layout.master')

<?php 

	var_dump($results[0]);


	?>

	{{ $value = Session::get('origin'); }}
	{{ $value = Session::get('destination'); }}

@section('content')
<div class="container">
	<div class='row'>
		<div class="demo-headline">
			<h1 class="demo-logo">
				<div class="logo"></div>
				Flat UI
				<small>Free User Interface Kit</small>
			</h1>
		</div> <!-- /demo-headline -->
	

		  <div class="row demo-row">
		    <div class="col-xs-12">
		      <nav class="navbar navbar-inverse navbar-embossed" role="navigation">
		        <div class="collapse navbar-collapse navbar-right" id="navbar-collapse-01">
		          <ul class="nav navbar-nav">
		            <li class="#">{{ link_to('/','Search Flight') }}<span class=""></span></a></li>
		            <li class="active">{{ link_to('/select','Select Flight') }}<span class=""></span></a></li>
		            <li class="disabled"><a href="#fakelink">Guest Details<span class=""></span></a></li>
		            <li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
		           </ul>
		        </div><!-- /.navbar-collapse -->
		      </nav><!-- /navbar -->
		    </div>
		  </div> <!-- /row -->

		{{ Form::open(['url'=>'/']) }}

		<div class="col-md-12">
			<div class="col-md-4">
				<h5 class='summary-heading'>Trip Summary</h5>
					<h6 class='summary-title'>Departure</h6>
					<span>Flight:</span>&nbsp;&nbsp;wtfwtfwtfwtfwtf<span id='oFlight'></span><br />
					<span>Depart:</span>&nbsp;&nbsp;<span id='oDepart'></span><br />
					<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'></span><br />
					<span>Arrive:</span>&nbsp;&nbsp;<span id='oArrive'></span><br />
					<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'></span>
	                <div class="summary-divider"></div>
			</div>

			<div class="col-md-8">
		    <h4>Departure Trip</h4>
		    <br>
			<table class="table table-list-searcha">
				<thead>
					<tr>
						<th><b>Flight</b></th>
						<th><b>Departure</b></th>
						<th><b>Arrival</b></th>
						<th><b>Trip Duration</b></th>
		                <th><b>Price</b></th>
						<th><b>Available</b></th>
					</tr>
				</thead>
				<tbody>
					<td>flights...</td>
				</tbody>
			</div>

		</div>

		  

		  {{ Form::close() }}

	</div> <!-- /row -->
</div> <!-- /container -->
@endsection