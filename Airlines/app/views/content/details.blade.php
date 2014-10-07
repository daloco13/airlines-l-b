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
		            <li class="#"><a href="#fakelink">Search Flight<span class=""></span></a></li>
		            <li class="#"><a href="#fakelink">Select Flight<span class=""></span></a></li>
		            <li class="active"><a href="#fakelink">Guest Details<span class=""></span></a></li>
		            <li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
		           </ul>
		        </div><!-- /.navbar-collapse -->
		      </nav><!-- /navbar -->
		    </div>
		  </div> <!-- /row -->

		{{ Form::open(['url'=>'/confirmation']) }}

		<?php 

			$adult = Session::get('adult') * $select[5];
			$children = Session::get('children') * $select[5] - ((Session::get('children') * $select[5])*.15);

			$total = $adult + $children;
		 ?>

		<div class="col-md-12">
			<div class="col-md-12">
			<div class="col-md-4 panel panel-default">
				<h5 class='summary-heading panel-heading'>Trip Summary</h5>
				<h6 class='summary-title'>Departure</h6>
				<span>Flight:</span>&nbsp;&nbsp;<span id='oFlight'> {{ $select[0] }} </span><br />
				<span>From:</span>&nbsp;&nbsp;<span id='oDepart'> {{ $select[1] }} </span><br />
				<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'> {{ $select[2] }} </span><br />
				<span>To:</span>&nbsp;&nbsp;<span id='oArrive'> {{ $select[3] }} </span><br />
				<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'> {{ $select[4] }} </span><br />
				<span>Total:</span>&nbsp;&nbsp;<span id='oFare'> {{ $select[5] }} </span><br />
				

				@if(Session::get('tripType') != 'oneway') 
				<div class="col-md-4">
					<h6 class='summary-title'>Return</h6>
					<span>Flight:</span>&nbsp;&nbsp;<span id='dFlight'></span><br />
					<span>From:</span>&nbsp;&nbsp;<span id='dDepart'></span><br />
					<span>Departure:</span>&nbsp;&nbsp;<span id='dDeparture'></span><br />
					<span>To:</span>&nbsp;&nbsp;<span id='dArrive'></span><br />
					<span>Arrival:</span>&nbsp;&nbsp;<span id='dArrival'></span><br />
					<div class="summary-divider"></div>
				</div>
				@endif

				<div class="col-md-4">
					<span>Total Passengers: <span class='summary-right'>{{ Session::get('total_passenger'); }}</span></span>
					<div class="<?php if(Session::get('adult') <= 0) echo "hide"; ?>"><span class='summary-name'>Adult x <span id="intAdult">{{ Session::get('adult'); }}</span></span><span class='summary-right'><span id="adultDep"> &nbsp;0</span> Php(Dep) 
					<?php if(Session::get('tripType') != 'oneway') echo ' + <span id="adultRet">0</span> Php(Ret)'; ?></span></div>
						<div class="<?php if(Session::get('children') <= 0) echo "hide"; ?>"><span class='summary-name'>Child (2-11) x <span id="intChild">{{ Session::get('children'); }}</span></span><span class='summary-right'><span id="childDep">   </span> Php(Dep) 

					<?php if(Session::get('tripType') != 'oneway') echo '+ <span id="childRet">0</span> Php(Ret)'; ?></span></div>
						<div class="summary-divider"></div>
						<h6 class='summary-heading'>Total: <span class='summary-right'><span id="total">{{ $total }}</span> Php</span></h6>
				</div>
			</div>

			<div class="col-md-9">
		    <h4>Contact Information</h4>
			<div class="input-group">
				<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			</div>
		    
		    <div class='form-row'>
		    <div class="panel">
				<div class='col-xs-16'>
					<div class='col-xs-6 form-group required'>
					<p><b>Address</b></p>
						{{ Form::select('country', ['country'=>'Select a Country', 'phil'=>'Philippines'],'', ['class'=>'form-control']) }}       
					</div>

					<div class='col-xs-6 form-group required'>
					<p>&nbsp;</p>
						{{ Form::text('city','', ['class'=>'form-control', 'placeholder'=>'Provide State/City']) }}       
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
				</div>	<!-- /panel -->
			</div> <!-- /form-row -->

			
			<?php for($i = 0; $i<Session::get('adult'); $i++) { ?>
		    <h4>Adult</h4>
			<div class="input-group">
				<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			</div>
		    
		    <div class='form-row'>
		    <div class="panel">
				<div class='col-xs-16'>
					<div class='col-xs-3 form-group required'>
					<p><b>Title</b></p>
						{{ Form::select('title', ['title'=>'Select Title', 'miss'=>'Miss', 'mister'=>'Mr', 'mrs'=>'Mrs'],'', ['class'=>'form-control']) }}       
					</div>

					<div class="col-xs-4 form-group required">
					<p><b>First Name</b></p>
						{{ Form::text('firstname','',['placeholder'=>'First Name', 'class'=>'form-control']) }}
					</div>

					<div class="col-xs-4 form-group required">
					<p><b>Second Name</b></p>
						{{ Form::text('secondname','',['placeholder'=>'Second Name', 'class'=>'form-control']) }}
					</div>

					<div class="col-xs-3 form-group required">
						<label class="control-label">Birth Date</label>
						<input autocomplete="off" class="form-control intBday" name="BDay" size="20" type="text">
					</div>

					<div class='col-xs-5 form-group required'>
					<p><b>Gender</b></p>
						{{ Form::select('gender', ['select'=>'Select a Title', 'master'=>'Master', 'miss'=>'Miss'], '', ['class'=>'form-control']) }}       
					</div>

			<?php } ?>

			<?php for($i = Session::get('adult'); $i<Session::get('adult') + Session::get('children'); $i++) { ?>
				<div class="form-row"><div class="col-md-12">
										<div class="panel panel-primary">
											<div class="panel-heading clickable">
												<h3 class="panel-title">Child - {{ ($i+1)-Session::get('adult'); }}</h3>

												<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
											</div>
											<div class="panel-body">
												<div class="form-row">
													<div class="col-xs-3 form-group required">
														<label class="control-label">Title</label>
														<select name="Title'.$i.'" id="Title" class="form-control">
															<option value="">Select Title</option>
															<option value="master">Master</option>
															<option value="miss">Miss</option>
														</select>
													</div>
													<div class="col-xs-4 form-group required">
														<label class="control-label">First Name</label>
														<input autocomplete="off" class="form-control"size="20" type="text" name="FName'.$i.'">
													</div>
													<div class="col-xs-5 form-group required">
														<label class="control-label">Last Name</label>
														<input autocomplete="off" class="form-control "size="20" type="text" name="LName'.$i.'">
													</div>
												</div>
												<div class="form-row">
													<div class="col-xs-3 form-group required">
														<label class="control-label">Birth Date</label>
														<input autocomplete="off" class="form-control intBday" name="BDay" size="20" type="text">
													</div>
													<div class="col-xs-4 form-group required">
														<label class="control-label">Gender</label>
														<select name="Gender'.$i.'" id="Gender" class="form-control">
															<option value="">Select Gender</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
													</div>
													<div class="col-xs-2">
														<input autocomplete="off" class="hide" type="text" name="Type'.$i.'" value="Child">
													</div>
												</div>
											</div>
										</div>
									</div></div>
			<?php } ?>

			<div class='form-row'>
				<div class='col-md-12 form-group'>
					{{ Form::submit('Submit', ['class'=>'btn btn-block btn-lg btn-primary', 'name'=>'submit', 'id'=>'submit']) }}
				</div>
			</div>
					</div>
				</div>	<!-- /form-row -->
			</div>

			

		</div>

		  

		  {{ Form::close() }}

	</div> <!-- col-md-12 -->

@endsection