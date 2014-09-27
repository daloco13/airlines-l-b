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

      <div class="row demo-row">
        <div class="col-xs-9">
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
      {{ Form::open(['url'=>'/']) }}

      <div class='form-row'>
		<div class='col-xs-2 form-group required'>
			{{ Form::radio('triptype','',['name'=>'intTripType', 'id'=>'intTripTypeReturn', 'onclick'=>'disablefield()', 'value'=>'roundtrip']) }}
			{{ Form::label('return','Round Trip', ['class'=>'control-label']) }}
		</div>
		<div class='col-xs-2 form-group required'>
			{{ Form::radio('triptype','',['name'=>'intTripType', 'id'=>'intTripTypeOneWay', 'onclick'=>'disablefield()', 'value'=>'oneway']) }}
			{{ Form::label('oneway','One Way', ['class'=>'control-label']) }}
		</div>
	  </div>

	<br />

	<!-- Origin -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
		{{ Form::select('from', ['from'=>'From'],'', ['class'=>'form-control', 'name'=>'from', 'id'=>'from']) }}       
		</div>
	</div>

	<!-- Destination -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			{{ Form::select('to', ['to'=>'To'],'', ['class'=>'form-control', 'name'=>'to', 'id'=>'to']) }}       
		</div>
	</div>

	<!-- Date Picker Departure Date -->
	<div class='form-row'>
		<div class='col-xs-9 form-group required'>
			{{ Form::text('departure','',['placeholder'=>'Departure', 'autocomplete'=>'off', 'class'=>'form-control', 'name'=>'intDepart', 'id'=>'intDepart', 'size'=>'20']) }}
		</div>
	</div>

	<!-- Date Picker Return Date -->
	<div class='form-row'>
		<div class='col-xs-9 form-group returnDate required'>
			{{ Form::text('return','',['placeholder'=>'Return', 'autocomplete'=>'off', 'class'=>'form-control', 'name'=>'intReturn', 'id'=>'intReturn', 'size'=>'20']) }}
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
	</div>

	{{ Form::close() }}
</div> <!-- /container -->
@endsection