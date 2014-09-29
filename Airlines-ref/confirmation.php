<!DOCTYPE html>
<html>
<head>
	<title>PUNX Airlines</title>
	<link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.10.2.js"/></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"/></script>
	<script type="text/javascript" src="js/bootstrap.js"/></script>

	<?php
		session_start();
		require_once('connector/db.php');
		$db = new DB();

		$tripType = $_SESSION['tripType'];

		$queryDepart = "SELECT *, r.RtID, r.Origin, ap.AirportCode AS oAirportCode, ap.Location AS oLocation, ap.Country AS oCountry, r.Destination, ap1.AirportCode AS dAirportCode, ap1.Location AS dLocation, ap1.Country AS dCountry FROM Flight_Schedule fs, AirFare af, Route r, Aircrafts ac, airport ap, airport ap1 WHERE fs.AirFare = af.AfID AND fs.AirCraft = ac.AcID AND af.Route = r.RtID AND r.Origin = ap.ApID AND  r.Destination = ap1.ApID AND fs.FsID = " . $_SESSION['FsIDOrigin'];
		  $resultsDepart = $db->getWhere($queryDepart);
		  if($tripType != 'oneway') {
				$queryReturn = "SELECT *, r.RtID, r.Origin, ap.AirportCode AS oAirportCode, ap.Location AS oLocation, ap.Country AS oCountry, r.Destination, ap1.AirportCode AS dAirportCode, ap1.Location AS dLocation, ap1.Country AS dCountry FROM Flight_Schedule fs, AirFare af, Route r, Aircrafts ac, airport ap, airport ap1 WHERE fs.AirFare = af.AfID AND fs.AirCraft = ac.AcID AND af.Route = r.RtID AND r.Origin = ap.ApID AND  r.Destination = ap1.ApID AND fs.FsID = " . $_SESSION['FsIDDestination'];
				$resultsReturn = $db->getWhere($queryReturn);
		  }
		  
		if(isset($_POST['submit'])) {
			header("location: processing.php");
		}
	?>
</head>
<body>
	 <?php require_once('header.php'); ?>
	
	<div class="content-section-a" id="search">
		<div class="container">
			<div class='row'>
				<div class='col-md-4'>
					<div class='col-xs-12 summary'>
						<h4 class='summary-heading'>Trip Summary</h4>
						<?php foreach ($resultsDepart as $v) { 
							$oAdult = $_SESSION['adult'] * $v['Fare'];
							$oChild = ($_SESSION['child'] * $v['Fare']) * 0.7;
								$oInfant = ($_SESSION['infant'] * $v['Fare']) * 0.6;
						?>
						<h5 class='summary-title'>Departing</h5>
						<h6><span class='summary-name'>Flight:</span>&nbsp;&nbsp;<span id='oFlight'><?= $v['AcName']; ?></span></h6>
						<h6><span class='summary-name'>Depart:</span>&nbsp;&nbsp;<span id='oDepart'><?= $v['oLocation'] . ', ' . $v['oCountry']; ?></span></h6>
						<h6><span class='summary-name'>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'><?= $v['Departure']; ?></span></h6>
						<h6><span class='summary-name'>Arrive:</span>&nbsp;&nbsp;<span id='oArrive'><?= $v['dLocation'] . ', ' . $v['dCountry']; ?></span></h6>
						<h6><span class='summary-name'>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'><?= $v['Arrival']; ?></span></h6>
						<div class="summary-divider"></div>
						<?php }
							if($tripType != 'oneway') {
								foreach ($resultsReturn as $v) {
									$dAdult = $_SESSION['adult'] * $v['Fare'];
									$dChild = ($_SESSION['child'] * $v['Fare']) * 0.7;
										$dInfant = ($_SESSION['infant'] * $v['Fare']) * 0.6;

								echo "<h5 class='summary-title'>Returning</h5>";
								echo "<h6><span class='summary-name'>Flight:</span>&nbsp;&nbsp;<span id='dFlight'>".$v['AcName']. "</span></h6>";
								echo "<h6><span class='summary-name'>Depart:</span>&nbsp;&nbsp;<span id='dDepart'>".$v['oLocation'] . ', ' . $v['oCountry']."</span></h6>";
								echo "<h6><span class='summary-name'>Departure:</span>&nbsp;&nbsp;<span id='dDeparture'>".$v['Departure']."</span></h6>";
								echo "<h6><span class='summary-name'>Arrive:</span>&nbsp;&nbsp;<span id='dArrive'>".$v['dLocation'] . ', ' . $v['dCountry']."</span></h6>";
								echo "<h6><span class='summary-name'>Arrival:</span>&nbsp;&nbsp;<span id='dArrival'>".$v['Arrival']."</span></h6>";
								echo "<div class='summary-divider'></div>";
								}
							}
						?>

						<h5 class="summary-title">Total Passengers: <span class='summary-right'><?php echo $_SESSION['totalPassenger']; ?></span></h5>
						<div class="summary-divider"></div>
						<div class="<?php if($_SESSION['adult'] <= 0) echo "hide"; ?>"><h6><span class='summary-name'>Adult x <span id="intAdult"><?php echo $_SESSION['adult']; ?></span></span><span class='summary-right'><span id="adultDep"><?= $oAdult; ?></span> Php(Dep) <?php if($tripType != 'oneway') echo ' + <span id="adultRet">'.$dAdult.'</span> Php(Ret)'; ?></span></h6></div>
						<div class="<?php if($_SESSION['child'] <= 0) echo "hide"; ?>"><h6><span class='summary-name'>Child (2-11) x <span id="intChild"><?php echo $_SESSION['child']; ?></span></span><span class='summary-right'><span id="childDep"><?= $oChild; ?></span> Php(Dep) <?php if($tripType != 'oneway') echo '+ <span id="childRet">'.$dChild.'</span> Php(Ret)'; ?></span></h6></div>
						<div class="<?php if($_SESSION['infant'] <= 0) echo "hide"; ?>"><h6><span class='summary-name'>Infant (<2) x <span id="intInfant"><?php echo $_SESSION['infant']; ?></span></span><span class='summary-right'><span id="infantDep"><?= $oInfant; ?></span> Php(Dep) <?php if($tripType != 'oneway') echo '+ <span id="infantRet">'.$dInfant.'</span> Php(Ret)'; ?></span></h6></div>
						<div class="summary-divider"></div>
						<?php 
							$total = $oAdult + $oChild + $oInfant;
							if($tripType != 'oneway')
								$total = $total + $dAdult + $dChild + $dInfant;
						?>
						<h4 class='summary-heading'>Total: <span class='summary-right'><span id="total"><?= $total ?></span> Php</span></h4>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading clickable">
									<h3 class="panel-title">Passenger Information</h3>
									<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
								</div>
								<div class="panel-body">
									<div class="col-xs-12"><h4>Contact Information</h4></div>
									<div class="col-xs-4">
										Address:
									</div>
									<div class="col-xs-8">
										<?php 
											echo $_SESSION['passengerContacts']['StreetAddress'] ."<br>". 
												$_SESSION['passengerContacts']['ZipCode'] ." ". $_SESSION['passengerContacts']['state'] .", ".
												$_SESSION['passengerContacts']['country'];
										?>
									</div>
									<div class="col-xs-4">
										Email:
									</div>
									<div class="col-xs-8">
										<?php 
											echo $_SESSION['passengerContacts']['Email'];
										?>
									</div>
									<div class="col-xs-4">
										Mobile:
									</div>
									<div class="col-xs-8">
										<?php 
											echo $_SESSION['passengerContacts']['Mobile'];
										?>
									</div>

									<div class="col-xs-12">&nbsp;</div>
									<div class="col-xs-12"><h4>Passenger Detail/s</h4></div>
									<?php
										$adultCount = 1;
										$childCount = 1;
										$infantCount = 1;
										foreach($_SESSION['passengerDetails'] as $variable) {
											echo '<div class="col-xs-4">
														'.$variable['Type'].' - ';
											if($variable['Type'] == 'Adult') {
												echo $adultCount;
												$adultCount++;
											} else if($variable['Type'] == 'Child') {
												echo $childCount;
												$childCount++;
											} else if($variable['Type'] == 'Infant') {
												echo $infantCount;
												$infantCount++;
											}
											echo ':
													</div>
										
													<div class="col-xs-8">
														'.$variable['Title'].' '.$variable['FName'].' '.$variable['LName'].'<br>
														'.$variable['BDay'].', '.$variable['Gender'].'
													</div>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-md-8'>
					<div class="col-xs-12">
						<ul class="nav nav-pills nav-justified thumbnail">
							<li><a href="index.php#search">
								<h4 class="list-group-item-heading">Search</h4>
								<p class="list-group-item-text">First step</p>
							</a></li>
							<li><a href="flights.php#search">
								<h4 class="list-group-item-heading">Flights</h4>
								<p class="list-group-item-text">Second step</p>
							</a></li>
							<li><a href="passengers.php#search">
								<h4 class="list-group-item-heading">Passengers</h4>
								<p class="list-group-item-text">Third step</p>
							</a></li>
							<li class="active"><a href="#search">
								<h4 class="list-group-item-heading">Confirmation</h4>
								<p class="list-group-item-text">Final step</p>
							</a></li>
						</ul>
					</div>



					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="require-validation" method="post">
						<div class='form-row'>
							<div class="col-md-12">
									<div class="panel panel-primary">
										 <div class="panel-heading">
											  <h3 class="panel-title">Agreements</h3>
										 </div>
										 <div class="panel-body">
											  <div class="tab-content">
													<div class="form-row">
														<ul>
															<li>Fuck Biboy ass.</li>
															<li>Throw the Shits on Biboy's face.</li>
															<li>Fuck the Mother of Biboy.</li>
															<li>Biboy is Bullshit.</li>
															<li>Let Biboy suck my Dick.</li>
															<li>Just follow the FUCKING rules.</li>
														</ul>
													</div>
												<div class="row" style="text-align: right;">
													<span class="button-checkbox form-group required">
													  <button type="button" class="btn control-label form-control" data-color="primary">I have read and fully understand the guidelines.</button>
													  <input type="checkbox" class="hidden" id="cbox" />
												 </span>
												</div>
											  </div>
										 </div>
									</div>
							  </div>
						</div>

						<div class='form-row'>
							<div class='col-md-12 form-group'>
								<button class='form-control btn btn-primary submit-button' type='submit' id='submit_button' name='submit' onclick="test()">Confirm</button>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-md-12 error form-group hide'>
								<div class='alert-danger alert'>
									Please accept the agreements and try again.
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		

	</div>
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

		$(document).ready(function(){
			$(function () {
				 $('.button-checkbox').each(function () {

					  // Settings
					  var $widget = $(this),
							$button = $widget.find('button'),
							$checkbox = $widget.find('input:checkbox'),
							color = $button.data('color'),
							settings = {
								 on: {
									  icon: 'glyphicon glyphicon-check'
								 },
								 off: {
									  icon: 'glyphicon glyphicon-unchecked'
								 }
							};

					  // Event Handlers
					  $button.on('click', function () {
							$checkbox.prop('checked', !$checkbox.is(':checked'));
							$checkbox.triggerHandler('change');
							updateDisplay();
					  });
					  $checkbox.on('change', function () {
							updateDisplay();
					  });

					  // Actions
					  function updateDisplay() {
							var isChecked = $checkbox.is(':checked');

							// Set the button's state
							$button.data('state', (isChecked) ? "on" : "off");

							// Set the button's icon
							$button.find('.state-icon')
								 .removeClass()
								 .addClass('state-icon ' + settings[$button.data('state')].icon);

							// Update the button's color
							if (isChecked) {
								 $button
									  .removeClass('btn-default')
									  .addClass('btn-' + color + ' active');
							}
							else {
								 $button
									  .removeClass('btn-' + color + ' active')
									  .addClass('btn-default');
							}
					  }

					  // Initialization
					  function init() {
							updateDisplay();

							// Inject the icon if applicable
							if ($button.find('.state-icon').length == 0) {
								 $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
							}
					  }
					  init();
				 });
			});
		});
	</script>
</body>
</html>