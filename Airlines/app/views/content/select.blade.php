@extends('layout.master')

@section('content')
<div class="container">
	<div class='row'>
		<div class="demo-headline">
			<div class="logo">{{ HTML::image('img/logo2.png', $alt="logo2", $attributes = array()) }}</div>
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
			<div class="col-md-4 panel panel-default">
				<h5 class='summary-heading panel-heading'>Fake Taxi</h5>
					<h6 class='summary-title'>Departure</h6>
					<span>Location:</span>&nbsp;&nbsp;<span id='oFlight'></span><br />
					<span>Depart:</span>&nbsp;&nbsp;<span id='oDepart'></span><br />
					<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'></span><br />
					<span>Arrive:</span>&nbsp;&nbsp;<span id='oArrive'></span><br />
					<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'></span>
	                <div class="summary-divider"></div>
			</div>

			<div class="col-md-8 panel panel-default">
		    <h4>Departure Trip</h4>
		    <br>
			<table class="table table-list-searcha">
				<thead>
					<tr>
						<th><b>From</b></th>
						<th><b>To</b></th>
						<th><b>Flight</b></th>
						<th><b>Fare</b></th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($results))
						@foreach($results as $key)
							<tr>
							<td>{{ $key->Location.' '.$key->departure }}</td>
							<td>{{ $value = Session::get('destination').' '.$key->arrival }}</td>
							<td>{{ $key->AcName }}</td>
							<td>{{ $key->fare }}</td>
							<td><input type="radio" name="selectplaneDepart" id="selectplaneDepart" value="<?php echo '.$key->Location.';'.$value.';'.$key->flightdate.';'.$key->departure.';'.$key->AcName.';'.$key->fare.'; ?> " onclick="writeResultDepart(value)" /></td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>Empty</td>
						</tr>
					@endif
				</tbody>
			</div>
		</table>
		</div>

		<div class="col-md-4"></div>
		<div class="col-md-8">
			<!-- Continue -->
		    <div class='form-row'>
				<div class='col-md-5 form-group'>
					{{ Form::submit('continue', ['class'=>'btn btn-block btn-lg btn-primary', 'name'=>'continue', 'id'=>'continue']) }}
				</div>
			</div>
		</div>

			  

		  {{ Form::close() }}

	</div> <!-- /row -->
</div> <!-- /container -->
@endsection