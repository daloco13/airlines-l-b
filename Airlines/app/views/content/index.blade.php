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
	
	<div class="col-md-12">

      <div class="row demo-row">
        <div class="col-xs-12">
          <nav class="navbar navbar-inverse navbar-embossed" role="navigation">
            <div class="collapse navbar-collapse navbar-right" id="navbar-collapse-01">
              <ul class="nav navbar-nav">
              	<li class="active">{{ link_to('/','Search Flight') }}<span class=""></span></a></li>
                <li class="disabled"><a href="#fakelink">Select Flight<span class=""></span></a></li>
                <li class="disabled"><a href="#fakelink">Guest Details<span class=""></span></a></li>
                <li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
               </ul>
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
        </div>
      </div> <!-- /row -->

      <!-- put form here -->
      {{ Form::open(array('url' => '/select', 'class'=>'require-validation')) }}

	  <div class="col-md-1"></div>
	  
	  <div class="col-md-11">
	  <!-- Trip Type -->
      <div class='form-row'>
		<div class='col-xs-2 form-group required'>
			<input type="radio" name="intTripType" id="intTripTypeOneWay" onclick="disablefield()" value="oneway" />
			{{ Form::label('oneway','One Way', ['class'=>'control-label']) }}
		</div>
		<div class='col-xs-2 form-group required'>
			<input type="radio" name="intTripType" id="intTripTypeReturn" onclick="disablefield()" value="return" checked="checked" />
			{{ Form::label('return','Round Trip', ['class'=>'control-label']) }}
		</div>
	  </div>

	<br />

	<!-- Origin -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
		<select name="intFrom" id="intFrom" class='form-control'>
			<option value="">From</option>
				@foreach($airports as $key)
				{{ '<option>'.$key->Location.'</option>' }}
				@endforeach
		</select>       
		</div>
	</div>

	<!-- Destination -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			<select name="intTo" id="intTo" class='form-control'>
				<option value="">To</option>
					@foreach($airports as $key)
					{{ '<option>'.$key->Location.'</option>' }}
					@endforeach
			</select> 
		</div>
	</div>

	<!-- Date Picker Departure Date -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			{{ Form::label('departure','Departure Date', ['class'=>'control-label']) }}
			<input autocomplete='off' class='form-control' name="intDepart" id="intDepart" size='20' type='text'>
		</div>
	</div>

	<!-- Date Picker Return Date -->
	<div class='form-row'>
		<div class='col-xs-9 form-group returnDate required'>
			{{ Form::label('return','Return', ['class'=>'control-label']) }}
			<input autocomplete='off' class='form-control' name="intReturn" id="intReturn" size='20' type='text'>
		</div>
	</div>

	<!-- People? -->
	<div class='form-row'>
		<div class='col-xs-4 form-group card required'>
		{{ Form::label('adult','Adult', ['class'=>'control-label']) }}
			<select name="intAdults" id="intAdults" class='form-control'>
				<?php for($i=1; $i<=7; $i++) { ?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<?php } ?>
			</select>
		</div>
		<div class='col-xs-4 form-group card required'>
		{{ Form::label('child','Child (below 12 years)', ['class'=>'control-label']) }}
			<select name="intChildren" id="intChildren" class='form-control'>
				<?php for($i=0; $i<=4; $i++) { ?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<?php } ?>
			</select>
		</div>

		<!-- Find it -->
	    <div class='form-row'>
			<div class='col-md-5 form-group'>
				{{ Form::submit('Find it', ['class'=>'btn btn-block btn-lg btn-primary', 'name'=>'submit', 'id'=>'submit']) }}
			</div>
		</div>

		<div class="col-md-9">
			<div class='form-row'>
				<div class='col-md-12 error form-group hide'>
					<div class='alert-danger alert'>
						Please correct the errors and try again.
					</div>
				</div>
			</div>
		</div>

	</div>

	</div> <!-- /col-md-11 -->

	{{ Form::close() }}
	</div> 	<!-- /col-md-12 -->
</div> <!-- /container -->
@endsection