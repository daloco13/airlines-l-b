@extends('layout.master')

@section('content')

<?php 

	Session::put('input',$input);

 ?>


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
							<li class="#">{{ link_to('/passengers','Guest Details') }}<span class=""></span></a></li>
							<li class="active"><a href="#fakelink">Confirmation<span class=""></span></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav><!-- /navbar -->
			</div>
		</div> <!-- /row -->

		{{ Form::open(array('url' => '/done', 'class'=>'require-validation')) }}


		<label for="name">Terms and Agreement</label>
		<textarea class="form-control" rows="25">General Terms and Conditions of Carriage of Passengers and Baggage

			Clause 1 – Definitions

			“Airline” as used in these General Conditions refers to First Class, Inc. (“First Class Airlines”).
			“Baggage” means any personal property brought by the Passenger. Unless otherwise specified, it includes both Checked and Hand Baggage.
			“Baggage Tag” means a document issued by the Airline to identify a Checked Baggage.
			“Checked Baggage” means baggage which has been checked in for carriage in the cargo hold of the aircraft and for which the Airline has issued a Baggage Tag while “Hand Baggage” means any baggage and all other items brought by the passenger into the aircraft cabin.
			“Cancellation” means the act of calling off a flight.
			“Check-in deadline” refers to the point in time before the published ETD on or before which a passenger must present himself to the airline check-in counter not less than forty-five (45) minutes before such ETD. The check-in deadline shall be determined by the Airline and may be changed from time to time.
			“Check-in period” is the time when the airline’s check-in counters open to accept and process passengers checking in for their flights and closes not less than forty-five (45) minutes, before such ETD. The check-in period shall be determined by the Airline and may be changed from time to time
			“Damage” includes death, bodily injury to a Passenger, loss, partial loss or other damage, arising out of or in connection with carriage by air.
			“Delay” is the result of the deferment of a flight to a later time. “Terminal Delay” is a delay that occurs while passengers are still inside the terminal waiting for boarding, while “Tarmac Delay” is a delay that occurs while passengers are already onboard the aircraft, reckoned from the closing of the aircraft doors, or when the aircraft is at the gate with the doors still open but passengers are not allowed to deplane.
			“Fare” is payment in consideration for the carriage of a passenger and may either be “Regular Fare” which the Airline offers on a regular basis or “Promotional Fare” which is generally lower in price and usually limited as to time, usage, and space availability.
			“General Conditions” relates to these general terms and conditions of carriage of the Airline.
			“Itinerary Receipt” means a document that includes the Passenger’s name, flight information, booking number, excerpts or summary of the General Conditions and the notices.
			“No-show” is the failure of the passenger to appear at the check-in counter within the check-in deadline or to show up at the boarding gate at the time indicated on the boarding pass.
			“Passenger” refers to a person traveling by air whose name appears in the Airline’s itinerary receipt.
			“Passenger Name Record” (PNR) or “Record Locator” is the alphanumeric code used in the Airline’s reservation system pertaining to the passenger’s specific seat reservation or booking reference.
			“Person with disability” or “PWD” refers to any person who is suffering from restriction or different abilities, as a result of a mental, physical or sensory impairment, to perform an activity in the manner or within the range considered normal for a human being.
			“Person with Reduced or Limited Mobility” or “PRM” (EU Regulation No. 1107/2006) refers to a person whose mobility when using transport is reduced due to any physical disability (sensory or locomotor, permanent or temporary), intellectual disability or impairment, or any other cause of disability, or age, and whose situation needs appropriate attention and the adaptation to his or her particular needs of the service made available to all passengers
			“Regulations” refer to policies adopted by the Airline from time to time which the Airline may publish on its website or elsewhere, or statements contained in or delivered with the Itinerary Receipt, and notices available at the Airline’s offices or the offices of its authorized representatives and at the check-in counters.
			“Seat” means a seat in the Airline’s aircraft on a specific date and on a specific flight.
			“Sector” means the flight from the airport at the point of origin to the airport at the point of destination. “Sum of Sectors” or “Through Fares” refers to a combination of two connecting sectors which will be treated as one flight and must be used in sequence as booked.
			“Senior citizen” refers to any resident citizen of the Philippines at least sixty (60) years old.
			“Tariff” means the Airline’s published fares and charges.
			“Travel Fund” means the fund created for the Passenger’s convenience which can be used to offset the expenses of future bookings.</textarea>
		</div>

		<div class="row" style="text-align: right;">
			<span class="button-checkbox form-group required">
				<button type="button" class="form-control" data-color="primary"><input type="checkbox" class="" id="cbox" />I have read and fully understand the guidelines.</button>

			</span>
		</div>
		<div class='form-row'>
		<div class='col-md-12 form-group'>
				<input type="submit" name="submit" id="submit_button" value="Confirm" class='form-control btn btn-primary submit-button'>
			</div>
		</div>
		<div class='form-row'>
			<div class='col-md-12 error form-group hide'>
				<div class='alert-danger alert'>
					Please accept the agreements and try again.
				</div>
			</div>
		</div>


		{{ Form::close() }}
		<script type="text/javascript">
			$(function() {
				$('form.require-validation').bind('submit', function(e) {
					var $form          = $(e.target).closest('form');
					inputSelector = ['input[type=checkbox]', 'select'].join(', ');

					$inputs       = $form.find('.required').find(inputSelector),
					$errorMessage = $form.find('div.error'),
					valid         = true;				

					// $("#submit_button").removeAttr('data-toggle');
					// $("#submit_button").removeAttr('data-target');
					$errorMessage.addClass('hide');
					$('.has-error').removeClass('has-error');
					$inputs.each(function(i, el) {
						var $input = $(el);
						if (!$("#cbox").is(":checked")) {
							$input.parent().addClass('has-error');
							$errorMessage.removeClass('hide');
					// $("#submit_button").attr('data-toggle','modal');
					// $("#submit_button").attr('data-target','#processing-modal');
					e.preventDefault(); // cancel on first error
					}
					});
					});
			});


		</script>
		@endsection

