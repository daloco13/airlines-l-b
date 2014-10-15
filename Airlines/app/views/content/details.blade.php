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
							<li class="#">{{ link_to('/select','Select Flight') }}<span class=""></span></a></li>
							<li class="active">{{ link_to('/passengers','Guest Details') }}<span class=""></span></a></li>
							<li class="disabled"><a href="#fakelink">Confirmation<span class=""></span></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav><!-- /navbar -->
			</div>
		</div> <!-- /row -->

		{{ Form::open(array('url' => '/finale', 'class'=>'require-validation')) }}

		<?php 

		//	computation for departure fare
		$adult = Session::get('adult') * $select[5];
		$children = Session::get('children') * $select[5] - ((Session::get('children') * $select[5])*.15);
		$total = $adult + $children;
		Session::put('done_total', $total);

		//	computation for departure and route fare
		if(Session::get('tripType')!='oneway')
		{
			$adult = Session::get('adult') * $select_2[5];
			$children = Session::get('children') * $select_2[5] - ((Session::get('children') * $select_2[5])*.15);
			$total2 = $adult + $children;
			Session::put('total2', $total2);

			$total_rt = $total + $total2;
			Session::put('total_rt', $total_rt);

		}

	
		
		Session::put('select', $select);

		?>

		<div class="col-md-12">
			<div class="col-md-4 panel panel-default">
				<h5 class='summary-heading panel-heading'>Trip Summary</h5>
				<h6 class='summary-title'>Departure</h6>
				<span>Flight:</span>&nbsp;&nbsp;<span id='oFlight'> {{ $select[0] }} </span><br />
				<span>From:</span>&nbsp;&nbsp;<span id='oDepart'> {{ Session::get('origin') }} {{ $select[1] }} </span><br />
				<span>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'> {{ $select[2] }} </span><br />
				<span>To:</span>&nbsp;&nbsp;<span id='oArrive'> {{ Session::get('destination') }} {{ $select[3] }} </span><br />
				<span>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'> {{ $select[4] }} </span><br />
				


				@if(Session::get('tripType') != 'oneway') 
				<!-- 	<div class="col-md-4"> -->
				<h6 class='summary-title'>Return</h6>
				<span>Flight:</span>&nbsp;&nbsp;{{ $select_2[0] }}<span id='dFlight'></span><br />
				<span>From:</span>&nbsp;&nbsp; {{ Session::get('destination') }} {{ $select_2[1] }}<span id='dDepart'></span><br />
				<span>Departure:</span>&nbsp;&nbsp;{{ $select_2[2] }}<span id='dDeparture'></span><br />
				<span>To:</span>&nbsp;&nbsp; {{ Session::get('origin') }} {{ $select_2[3] }}<span id='dArrive'></span><br />
				<span>Arrival:</span>&nbsp;&nbsp;{{ $select_2[4] }}<span id='dArrival'></span><br />
				<div class="summary-divider"></div>
				<!-- 	</div> -->
				@endif


				<span>Total Passengers: <span class='summary-right'>{{ Session::get('total_passenger'); }}</span></span>
				<div class="<?php if(Session::get('adult') <= 0) echo "hide"; ?>"><span class='summary-name'>Adult x <span id="intAdult">{{ Session::get('adult'); }}</span></span><span class='summary-right'><span id="adultDep"> &nbsp; {{ $total }} </span> Php(Dep) 
					<?php if(Session::get('tripType') != 'oneway') echo ' + <span id="adultRet"> '.$total2.' </span> Php(Ret)'; ?></span></div>
						<div class="<?php if(Session::get('children') <= 0) echo "hide"; ?>"><span class='summary-name'>Child (2-11) x <span id="intChild">{{ Session::get('children'); }}</span></span><span class='summary-right'><span id="childDep"> {{ $children }}  </span> Php(Dep) 

							<?php if(Session::get('tripType') != 'oneway') echo '+ <span id="childRet">0</span> Php(Ret)'; ?></span></div>
								<div class="summary-divider"></div>
								<h6 class='summary-heading'>Total: <span class='summary-right'><span id="total"> @if(Session::get('tripType') != 'oneway'){{ $total_rt }} @else {{ $total }} @endif </span> Php</span></h6>
							</div>

						<?php  
							//	summary of trip departure
							$summary_0 = $select[0];
							$summary_1 = $select[1];
							$summary_2 = $select[2];
							$summary_3 = $select[3];
							$summary_4 = $select[4];

							Session::put('summary_0', $summary_0);
							Session::put('summary_1', $summary_1);
							Session::put('summary_2', $summary_2);
							Session::put('summary_3', $summary_3);
							Session::put('summary_4', $summary_4);

							//	summary of trip return
							$summary2_0 = $select_2[0];
							$summary2_1 = $select_2[1];
							$summary2_2 = $select_2[2];
							$summary2_3 = $select_2[3];
							$summary2_4 = $select_2[4];

							Session::put('summary2_0', $summary2_0);
							Session::put('summary2_1', $summary2_1);
							Session::put('summary2_2', $summary2_2);
							Session::put('summary2_3', $summary2_3);
							Session::put('summary2_4', $summary2_4);

						?>


							<div class="col-md-8">
								<h4>Contact Information</h4>

								<div class='form-row'>
									<div class="panel">
										<div class='col-xs-16'>
											<div class='col-xs-6 form-group required'>
												<p><b>Address</b></p>
												{{ Form::select('country', ['country'=>'Select a Country', 'Philippines'=>'Philippines'],'', ['class'=>'form-control']) }}       
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
												{{ Form::text('Mobile', '', ['class'=>'form-control', 'placeholder'=>'Mobile Phone', 'id'=>'Mobile']) }}       
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-md-8">

								<?php for($i = 0; $i<Session::get('adult'); $i++) { ?>

									<div class="form-row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading clickable">
													<h3 class="panel-title">Adult</h3>

												</div>
												<div class="panel-body">
													<div class="form-row">
														<div class="col-xs-3 form-group required">
															<label class="control-label">Title</label>
															<select name="Title" id="Title" class="form-control">
																<option value="">Title</option>
																<option value="Master">Master</option>
																<option value="Miss">Miss</option>
															</select>
														</div>
														<div class="col-xs-4 form-group required">
															<label class="control-label">First Name</label>
															<input autocomplete="off" class="form-control"size="20" type="text" name="FName<?php '.$i.' ?>">
														</div>
														<div class="col-xs-5 form-group required">
															<label class="control-label">Last Name</label>
															<input autocomplete="off" class="form-control "size="20" type="text" name="LName<?php '.$i.' ?>">
														</div>
													</div>
													<div class="form-row">
														<div class="col-xs-3 form-group required">
															<label class="control-label">Birth Date</label>
															<input autocomplete="off" class="form-control intBday" name="BDay" size="20" type="text">
														</div>
														<div class="col-xs-4 form-group required">
															<label class="control-label">Gender</label>
															<select name="Gender<?php '.$i.' ?>" id="Gender" class="form-control">
																<option value="">Select Gender</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
														<div class="col-xs-2">
															<input autocomplete="off" class="hide" type="text" name="TypeGender<?php '.$i.' ?>" value="Child">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php } ?>

									<?php for($i = Session::get('adult'); $i<Session::get('adult') + Session::get('children'); $i++) { ?>
										<div class="form-row">
											<div class="col-md-12">
												<div class="panel panel-default">
													<div class="panel-heading clickable">
														<h3 class="panel-title">Child - {{ ($i+1)-Session::get('adult'); }}</h3>
													</div>
													<div class="panel-body">
														<div class="form-row">
															<div class="col-xs-3 form-group required">
																<label class="control-label">Title</label>
																<select name="Title<?php '.$i.' ?>" id="Title" class="form-control">
																	<option value="">Title</option>
																	<option value="Master">Master</option>
																	<option value="Miss">Miss</option>
																</select>
															</div>
															<div class="col-xs-4 form-group required">
																<label class="control-label">First Name</label>
																<input autocomplete="off" class="form-control"size="20" type="text" name="FName<?php '.$i.' ?>">
															</div>
															<div class="col-xs-5 form-group required">
																<label class="control-label">Last Name</label>
																<input autocomplete="off" class="form-control "size="20" type="text" name="LName<?php '.$i.' ?>">
															</div>
														</div>
														<div class="form-row">
															<div class="col-xs-3 form-group required">
																<label class="control-label">Birth Date</label>
																<input autocomplete="off" class="form-control intBday" name="BDay" size="20" type="text">
															</div>
															<div class="col-xs-4 form-group required">
																<label class="control-label">Gender</label>
																<select name="Gender<?php '.$i.' ?>" id="Gender" class="form-control">
																	<option value="">Select Gender</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															</div>
															<div class="col-xs-2">
																<input autocomplete="off" class="hide" type="text" name="Type<?php '.$i.' ?>" value="Child">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>

										<div class='form-row'>
											<div class='col-md-12 form-group'>
												{{ Form::submit('Submit', ['class'=>'btn btn-block btn-lg btn-primary', 'name'=>'submit', 'id'=>'submit']) }}
											</div>
										</div>
										<div class='form-row'>

										<div class='col-md-12 error form-group hide'>
											<div class='alert-danger alert'>
												<span id="error">Please correct the errors and try again.</span>
											</div>
										</div>

									</div>
									</div>
								</div>	<!-- /form-row -->
							</div>



						</div>



						{{ Form::close() }}

					</div> <!-- col-md-12 -->
					<script type="text/javascript">
						$(function() {
							$('form.require-validation').bind('submit', function(e) {
								var $form          = $(e.target).closest('form');
								inputSelector = ['input[type=text]', 'select'].join(', ');
								
								$inputs       = $form.find('.required').find(inputSelector),
								$errorMessage = $form.find('div.error'),
								valid         = true;				

								$errorMessage.addClass('hide');
								$('.has-error').removeClass('has-error');
								$inputs.each(function(i, el) {
									var $input = $(el);
									if ($input.val() === '') {
										$input.parent().addClass('has-error');
										$("#error").html("Please correct the errors and try again.");
										$errorMessage.removeClass('hide');
				        				e.preventDefault(); // cancel on first error
				        			} else if ($("#Email").val() !== $("#ConfirmEmail").val()) {
				        				$("#Email").parent().addClass('has-error');
				        				$("#ConfirmEmail").parent().addClass('has-error');
				        				$("#error").html("Email Address is not the same.");
										$errorMessage.removeClass('hide');
										e.preventDefault();
				        			} else if (!$.isNumeric($("#Mobile").val())) {
				        				$("#Mobile").parent().addClass('has-error');
				        				$("#error").html("Mobile Phone must be numeric.");
										$errorMessage.removeClass('hide');
										e.preventDefault();
				        			}
				        		});
							});
						});
					</script>
					@endsection

					