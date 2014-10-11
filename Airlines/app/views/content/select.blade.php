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

		{{ Form::open(array('url' => '/passengers', 'class'=>'require-validation')) }}

		<div class="col-md-12">
			<div class="col-md-4 panel panel-default">
				<h5 class='summary-heading panel-heading'>Trip Summary</h5>
				<h6 class='summary-title'>Departure</h6>
				<span>Flight:</span>&nbsp;&nbsp;<span id='oFlight'></span><br />
				<span>From:</span>&nbsp;&nbsp;<span id='oDepart'></span><br />
				<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'></span><br />
				<span>To:</span>&nbsp;&nbsp;<span id='oArrive'></span><br />
				<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'></span><br />

				@if(Session::get('tripType') != 'oneway') 
				<!-- 	<div class="col-md-4"> -->
				<h6 class='summary-title'>Return</h6>
				<span>Flight:</span>&nbsp;&nbsp;<span id='dFlight'></span><br />
				<span>From:</span>&nbsp;&nbsp;<span id='dDepart'></span><br />
				<span>Departure:</span>&nbsp;&nbsp;<span id='dDeparture'></span><br />
				<span>To:</span>&nbsp;&nbsp;<span id='dArrive'></span><br />
				<span>Arrival:</span>&nbsp;&nbsp;<span id='dArrival'></span><br />
				<div class="summary-divider"></div>
				<!-- </div> -->
				@endif

				<!-- 		<div class="col-md-4"> -->
				<span>Total Passengers: <span class='summary-right'>{{ Session::get('total_passenger'); }}</span></span>
				<div class="<?php if(Session::get('adult') <= 0) echo "hide"; ?>"><span class='summary-name'>Adult x <span id="intAdult">{{ Session::get('adult'); }}&nbsp;</span></span><span class='summary-right'><span id="adultDep">0&nbsp;&nbsp;</span> Php(Dep) 
					<?php if(Session::get('tripType') != 'oneway') echo ' + <span id="adultRet">0</span> Php(Ret)'; ?></span></div>
						<div class="<?php if(Session::get('children') <= 0) echo "hide"; ?>"><span class='summary-name'>Child (2-11) x <span id="intChild">{{ Session::get('children'); }} &nbsp;</span></span><span class='summary-right'><span id="childDep">&nbsp;0</span> Php(Dep) 

							<?php if(Session::get('tripType') != 'oneway') echo '+ <span id="childRet">0</span> Php(Ret)'; ?></span></div>
								<div class="summary-divider"></div>
								<h6 class='summary-heading'>Total: <span class='summary-right'><span id="total">0</span> Php</span></h6>
							</div>
							<!-- 	</div> -->

							<!-- 	<div class="col-md-1"></div> -->

							<div class="col-md-8 panel panel-default">
								<h4>Departure Trip</h4>
								From <b> {{ Session::get('origin') }} </b> to <b> {{ Session::get('destination') }} </b>
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
											<td>{{ $key->AirportCode.' '.$key->departure }}</td>
											<td>{{ $key->Origin.' '.$key->arrival }}</td>
											<td>{{ $key->AcName }}</td>
											<td>{{ $key->fare }}</td>
											<td>{{ '<input type="radio" name="selectplaneDepart" id="selectplaneDepart" value=" '.$key->AcName.';'.$key->Origin.';'.$key->departure.';'.$key->Destination.';'.$key->arrival.';'.$key->fare.' " onclick="writeResultDepart(value)" />'  }}</td>
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


						<div class="col-md-8 panel panel-default <?php if(Session::get('tripType') == 'oneway') echo 'hide'; ?>">
							<h4>Returning Trip</h4>
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
										<td>{{ $key->Origin.' '.$key->departure }}</td>
										<td>{{ $key->Destination.' '.$key->arrival }}</td>
										<td>{{ $key->AcName }}</td>
										<td>{{ $key->fare }}</td>
										<td>{{ '<input type="radio" name="selectplaneReturn" id="selectplaneReturn" value=" '.$key->AcName.';'.$key->Origin.';'.$key->departure.';'.$key->Destination.';'.$key->arrival.';'.$key->fare.' " onclick="writeResultReturn(value)" />' }}</td>
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
							<div class='col-md-12 form-group'>
								{{ Form::submit('Continue', ['class'=>'btn btn-block btn-lg btn-primary', 'name'=>'submit', 'id'=>'submit']) }}
							</div>
						</div>
					</div>
					<div class='form-row'>
						<div class='col-md-12 error form-group hide'>
							<div class='alert-danger alert'>
								Please choose the available flight and try again.
							</div>
						</div>
					</div>



					{{ Form::close() }}

				</div> <!-- /row -->
			</div> <!-- /container -->
			@endsection

			<script type="text/javascript">
				$(function() {
					$('form.require-validation').bind('submit', function(e) {
						if(!$("input[name=selectplaneDepart]:checked").val()) {
							$('.hide').removeClass('hide');
							e.preventDefault();
						}


						<?php
						if(Session::get('tripType') != 'oneway') {
							echo "if(!$('input[name=selectplaneReturn]:checked').val()) {
								$('.hide').removeClass('hide');
								e.preventDefault();}";
							}
							?>
						});
				});
			</script>