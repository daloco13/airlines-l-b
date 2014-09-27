@extends('layout.master')

@section('content')
<div class="container">

	<div class="demo-headline">
		<h1 class="demo-logo">
			<div class="logo"></div>
			Flat UI
			<small>Free User Interface Kit</small>
		</h1>
	</div> <!-- /demo-headline -->

	<h3 class="demo-panel-title">Navbar</h3>
      <div class="row demo-row">
        <div class="col-xs-10">
          <nav class="navbar navbar-inverse navbar-embossed" role="navigation">

            <div class="collapse navbar-collapse" id="navbar-collapse-01">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#fakelink">Search Flight<span class=""></span></a></li>
                <li class="disabled"><a href="#fakelink">Select Flight<span class=""></span></a></li>
                <li class="disabled"><a href="#fakelink">Guest Details<span class=""></span></a></li>
                <li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
               </ul>
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
        </div>
      </div> <!-- /row -->

      <!-- put form here -->

      <div class='form-row'>
		<div class='col-xs-2 form-group required'>
			<label class='control-label'>Return</label>&nbsp;
			<input type="radio" name="intTripType" id="intTripTypeReturn" onclick="disablefield()" value="return" checked="checked" />
		</div>
		<div class='col-xs-2 form-group required'>
			<label class='control-label'>One Way</label>&nbsp;
			<input type="radio" name="intTripType" id="intTripTypeOneWay" onclick="disablefield()" value="oneway" />
		</div>
		<div class='col-xs-2 form-group required'></div>
		<div class='col-xs-6 form-group required'></div>
	</div>

	<br />

	<!-- Origin -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			<label class='control-label'>Where you are flying from</label>
			<select name="intFrom" id="intFrom" class='form-control'>
				<option value="">Where you are flying from</option>
				
			</select>
		</div>
	</div>

	<!-- Destination -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			<label class='control-label'>Where you are flying to</label>
			<select name="intTo" id="intTo" class='form-control'>
				<option value="">Where you are flying to</option>
				
			</select>
		</div>
	</div>

	<!-- Date Picker Departure Date -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			<label class='control-label'>Departing Date</label>
			<input autocomplete='off' class='form-control' name="intDepart" id="intDepart" size='20' type='text'>
		</div>
	</div>

	<!-- Date Picker Return Date -->
	<div class='form-row'>
		<div class='col-xs-9 form-group returnDate required'>
			<label class='control-label'>Returning Date</label>
			<input autocomplete='off' class='form-control' name="intReturn" id="intReturn" size='20' type='text'>
		</div>
	</div>

	<!-- People? -->
	<div class='form-row'>
		<div class='col-xs-4 form-group card required'>
			<label class='control-label'>Adult</label>
			<select name="intAdults" id="intAdults" class='form-control'>
				<?php for($i=1; $i<=9; $i++) { ?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<?php } ?>
			</select>
		</div>
		<div class='col-xs-4 form-group card required'>
			<label class='control-label'>Child<small> (2-11)</small></label>
			<select name="intChildren" id="intChildren" class='form-control'>
				<?php for($i=0; $i<=4; $i++) { ?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<?php } ?>
			</select>
		</div>

		<!-- Find it -->
	    <div class='form-row'>
			<div class='col-md-5 form-group'>
				<button class="btn btn-block btn-lg btn-primary" type='submit' name='submit'>Find it</button>
			</div>
		</div>
	</div>

</div> <!-- /container -->
@endsection