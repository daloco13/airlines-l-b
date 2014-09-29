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
	<script type="text/javascript" src="city_state.js"/></script>

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

        // echo '<pre>';
        // print_r($resultsDepart);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($resultsReturn);
        // echo '</pre>';
        // echo $resultsDepart[0]['AcID'];

        $passengerContacts = array();
        $passengerDetails = array();
        
        if(isset($_POST['submit'])) {
			for($i=0; $i<$_SESSION['adult'] + $_SESSION['child'] + $_SESSION['infant']; $i++) {
				$passengerDetails[$i]['Title'] = ucwords(strtolower($_POST["Title{$i}"]));
				$passengerDetails[$i]['FName'] = ucwords(strtolower($_POST["FName{$i}"]));
				$passengerDetails[$i]['LName'] = ucwords(strtolower($_POST["LName{$i}"]));
				$passengerDetails[$i]['BDay'] = $_POST["BDay{$i}"];
				$passengerDetails[$i]['Gender'] = $_POST["Gender{$i}"];
				$passengerDetails[$i]['Type'] = $_POST["Type{$i}"];	
			}
			$passengerContacts['country'] = $_POST["country"];
			$passengerContacts['state'] = $_POST["state"];
			$passengerContacts['StreetAddress'] = ucwords(strtolower($_POST["StreetAddress"]));
			$passengerContacts['ZipCode'] = $_POST["ZipCode"];
			$passengerContacts['Email'] = $_POST["Email"];
			$passengerContacts['Mobile'] = $_POST["Mobile"];
			$_SESSION['passengerContacts'] = $passengerContacts;
			$_SESSION['passengerDetails'] = $passengerDetails;
			$_SESSION['departAircraftID'] = $resultsDepart[0]['AcID'];
			if($tripType != 'oneway') {
				$_SESSION['resultAircraftID'] = $resultsReturn[0]['AcID'];
			}
			header("location: confirmation.php#search");
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
							<li class="active"><a href="#search">
								<h4 class="list-group-item-heading">Passengers</h4>
								<p class="list-group-item-text">Third step</p>
							</a></li>
							<li class="disabled"><a href="#search">
								<h4 class="list-group-item-heading">Confirmation</h4>
								<p class="list-group-item-text">Final step</p>
							</a></li>
						</ul>
					</div>

					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="require-validation" method="post">
						<div class="row">
						<div class="form-row">
							<div class="col-md-12">
								<div class="panel panel-danger">
									<div class="panel-heading clickable">
										<h3 class="panel-title">Contact Information</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
									</div>
									<div class="panel-body">
										<div class="form-row">
											<div class="col-xs-6 form-group required">
												<label class="control-label">Address</label>
												<select class="form-control" id="country" name="country" onchange="print_state('state',this.selectedIndex);"></select>
											</div>
										</div>
										<div class="form-row">
											<div class="col-xs-6 form-group required">
												<label class="control-label">&nbsp;</label>
												<select class="form-control" id="state" name="state"><option value=''>Select State/City</option></select>
												<script language="javascript">print_country("country");</script>
											</div>
										</div>
										<div class="form-row">
											<div class="col-xs-9 form-group required">
												<input autocomplete="off" class="form-control"size="20" type="text" name="StreetAddress" id="StreetAddress" placeholder="Street Address">
											</div>
											<div class="col-xs-3 form-group required">
												<input autocomplete="off" class="form-control"size="20" type="text" name="ZipCode" id="ZipCode" placeholder="Zip Code">
											</div>
										</div>
										<div class="form-row">
											<div class="col-xs-6 form-group required">
												<label class="control-label">Email</label>
												<input autocomplete="off" class="form-control"size="20" type="text" name="Email" id="Email">
											</div>
											<div class="col-xs-6 form-group required">
												<label class="control-label">Confirm Email</label>
												<input autocomplete="off" class="form-control"size="20" type="text" name="ConfirmEmail" id="ConfirmEmail">
											</div>
										</div>
										<div class="form-row">
											<div class="col-xs-6 form-group required">
												<label class="control-label">Mobile Phone</label>
												<input autocomplete="off" class="form-control"size="20" type="text" name="Mobile" id="Mobile">
											</div>
											<div class="col-xs-6 form-group required">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php 
							for($i = 0; $i<$_SESSION['adult']; $i++)
								echo '<div class="form-row"><div class="col-md-12">
											<div class="panel panel-primary">
												<div class="panel-heading clickable">
													<h3 class="panel-title">Adult - '.($i+1).'</h3>
													<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
												</div>
												<div class="panel-body">
													<div class="form-row">
														<div class="col-xs-3 form-group required">
														<label class="control-label">Title</label>
														<select name="Title'.$i.'" id="titleAdult" class="form-control">
															<option value="">Select Title</option>
															<option value="mr">Mr.</option>
															<option value="mrs">Mrs.</option>
															<option value="master">Master</option>
															<option value="miss">Miss</option>
														</select>
													</div>
													<div class="col-xs-4 form-group required">
														<label class="control-label">First Name</label>
														<input autocomplete="off" class="form-control "size="20" type="text" name="FName'.$i.'">
													</div>
													<div class="col-xs-5 form-group required">
														<label class="control-label">Last Name</label>
														<input autocomplete="off" class="form-control "size="20" type="text" name="LName'.$i.'">
													</div>
												</div>
												<div class="form-row">
													<div class="col-xs-3 form-group required">
														<label class="control-label">Birth Date</label>
														<input autocomplete="off" class="form-control intBday" name="BDay'.$i.'" size="20" type="text">
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
														<input autocomplete="off" class="hide" type="text" name="Type'.$i.'" value="Adult">
													</div>
												</div>
											</div>
										</div>
									</div></div>';

							for($i = $_SESSION['adult']; $i<$_SESSION['adult'] + $_SESSION['child']; $i++)
								echo '<div class="form-row"><div class="col-md-12">
										<div class="panel panel-primary">
											<div class="panel-heading clickable">
												<h3 class="panel-title">Child - '.(($i+1)-$_SESSION['adult']).'</h3>
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
														<input autocomplete="off" class="form-control intBday" name="BDay'.$i.'" size="20" type="text">
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
									</div></div>';

							for($i = $_SESSION['adult'] + $_SESSION['child']; $i<$_SESSION['adult'] + $_SESSION['child'] + $_SESSION['infant']; $i++)
								echo '<div class="form-row"><div class="col-md-12">
									<div class="panel panel-primary">
										<div class="panel-heading clickable">
											<h3 class="panel-title">Infant - '.(($i+1)-$_SESSION['adult'] + $_SESSION['child']).'</h3>
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
													<input autocomplete="off" class="form-control"size="20" type="text" name="LName'.$i.'">
												</div>
											</div>
											<div class="form-row">
												<div class="col-xs-3 form-group required">
													<label class="control-label">Birth Date</label>
													<input autocomplete="off" class="form-control intBday" name="BDay'.$i.'" size="20" type="text">
												</div>
												<div class="col-xs-4 form-group required">
													<label class="control-label">Gender</label>
													<select name="Gender'.$i.'" id="Gender" class="form-control">															<option value="">Select Gender</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
												<div class="col-xs-2">
													<input autocomplete="off" class="hide" type="text" name="Type'.$i.'" value="Infant">
												</div>
											</div>
										</div>
									</div>
								</div></div>';
						?>
						</div>
						<div class='form-row'>
							<div class='col-md-12 form-group'>
								<button class='form-control btn btn-primary submit-button' type='submit' name='submit'>Submit</button>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-md-12 error form-group hide'>
								<div class='alert-danger alert'>
									<span id="error">Please correct the errors and try again.</span>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).on('click', '.panel div.clickable', function(e){
		    var $this = $(this);
			if(!$this.hasClass('panel-collapsed')) {
				$this.parents('.panel').find('.panel-body').slideUp();
				$this.addClass('panel-collapsed');
				$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
			} else {
				$this.parents('.panel').find('.panel-body').slideDown();
				$this.removeClass('panel-collapsed');
				$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up')
			}
		})

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

		$(document).ready(function(){
			$(".intBday").datepicker({
				dateFormat: 'yy-mm-dd',
				changeYear: true,
				changeMonth: true,
				showMonthAfterYear: true,
				maxDate: 0
			});
		});

	</script>
</body>
</html>