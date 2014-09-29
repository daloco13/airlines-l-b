@extends('layout.master')

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

		        <div class="collapse navbar-collapse" id="navbar-collapse-01">
		          <ul class="nav navbar-nav">
		            <li class="#"><a href="#fakelink">Search Flight<span class=""></span></a></li>
		            <li class="active"><a href="#fakelink">Select Flight<span class=""></span></a></li>
		            <li class="disabled"><a href="#fakelink">Guest Details<span class=""></span></a></li>
		            <li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
		           </ul>
		        </div><!-- /.navbar-collapse -->
		      </nav><!-- /navbar -->
		    </div>
		  </div> <!-- /row -->

		{{ Form::open(['url'=>'/']) }}

		<div class="col-md-12">
		    <h2>Departure Trip</h2>
			<div class="input-group">
				<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			</div>
		    <br>
			<table class="table table-list-searcha">
				<thead>
					<tr>
						<th><h6>Flight</h6></th>
						<th><h6>Depart</h6></th>
						<th><h6>Arive</h6></th>
						<th><h6>Trip Duration</h6></th>
		                <th><h6>Price</h6></th>
						<th><h6>Available</h6></th>
					</tr>
				</thead>
				<tbody>
					<td>flights...</td>
				</tbody>
		</div>


		  <!-- put form here -->
		  

		  

		  {{ Form::close() }}

	</div> <!-- /row -->
</div> <!-- /container -->
@endsection