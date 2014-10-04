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
		        <div class="collapse navbar-collapse" id="navbar-collapse-01">
		          <ul class="nav navbar-nav">
		            <li class="#"><a href="#fakelink">Search Flight<span class=""></span></a></li>
		            <li class="#"><a href="#fakelink">Select Flight<span class=""></span></a></li>
		            <li class="active"><a href="#fakelink">Guest Details<span class=""></span></a></li>
		            <li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
		           </ul>
		        </div><!-- /.navbar-collapse -->
		      </nav><!-- /navbar -->
		    </div>
		  </div> <!-- /row -->

		{{ Form::open(['url'=>'/']) }}

		<div class="col-md-12">
			<div class="col-md-4">
				<h4 class='summary-heading'>Trip Summary</h4>
					<h5 class='summary-title'>Departure</h5>
					<b><span>Flight:</span>&nbsp;&nbsp;wtfwtfwtfwtfwtf<span id='oFlight'></span></b><br />
					<b><span>Depart:</span>&nbsp;&nbsp;<span id='oDepart'></span></b><br />
					<b><span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'></span></b><br />
					<b><span>Arrive:</span>&nbsp;&nbsp;<span id='oArrive'></span></b><br />
					<b><span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'></span></b>
	                <div class="summary-divider"></div>
			</div>

			<div class="col-md-8">
		    <h4>Contact Information</h4>
			<div class="input-group">
				<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			</div>
		    
		    <div class='form-row'>
		    <div class="panel">
				<div class='col-xs-12'>
					<div class='col-xs-6 form-group required'>
					<p><b>Address</b></p>
						{{ Form::select('country', ['country'=>'Select a Country'],'', ['class'=>'form-control']) }}       
					</div>

					<div class='col-xs-6 form-group required'>
					<p>&nbsp;</p>
						{{ Form::select('city', ['city'=>'Select a State/City'],'', ['class'=>'form-control']) }}       
					</div>

					<div class="col-xs-9 form-group required">
						{{ Form::text('streetaddress','',['placeholder'=>'Street Address', 'class'=>'form-control']) }}
					</div>

					<div class="col-xs-3 form-group required">
						{{ Form::text('zipcode','',['placeholder'=>'Zip Code', 'class'=>'form-control']) }}
					</div>

					<div class='col-xs-6 form-group required'>
					<p><b>Email</b></p>
						{{ Form::text('email', '', ['class'=>'form-control', 'placeholder'=>'Email']) }}       
					</div>

					<div class='col-xs-6 form-group required'>
					<p><b>Mobile Phone</b></p>
						{{ Form::text('mobilephone', '', ['class'=>'form-control', 'placeholder'=>'Mobile Phone']) }}       
					</div>
					</div>
				</div>	<!-- /form-row -->
			</div>
		</div>

		  

		  {{ Form::close() }}

	</div> <!-- /row -->
</div> <!-- /container -->
@endsection