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

		$places = $db->getAll('airport');

		if(isset($_POST['submit'])) {
			$_SESSION['tripType'] = $_POST['intTripType'];
			$_SESSION['adult'] = $_POST['intAdults'];
			$_SESSION['child'] = $_POST['intChildren'];
			$_SESSION['infant'] = $_POST['intInfants'];
			$_SESSION['intFrom'] = $_POST['intFrom'];
			$_SESSION['intTo'] = $_POST['intTo'];
			$_SESSION['intDepart'] = $_POST['intDepart'];
			$_SESSION['intReturn'] = $_POST['intReturn'];
			$_SESSION['totalPassenger'] = $_POST['intAdults'] + $_POST['intChildren'] + $_POST['intInfants'];
			header("location: flights.php#search");
		}
	?>
</head>
<body>
    <?php require_once('header.php'); ?>
	
	<div class="content-section-a" id="search">
		<div class="container">
			<div class='row'>
				<div class='col-md-4' style="padding-bottom: 10px;">
	                <img class="img-responsive" src="img/doge.png" alt="">
				</div>
				<div class='col-md-8'>
					<div class="col-xs-12">
						<ul class="nav nav-pills nav-justified thumbnail">
							<li class="active"><a href="#search">
								<h4 class="list-group-item-heading">Search</h4>
								<p class="list-group-item-text">First step</p>
							</a></li>
							<li class="disabled"><a href="#search">
								<h4 class="list-group-item-heading">Flights</h4>
								<p class="list-group-item-text">Second step</p>
							</a></li>
							<li class="disabled"><a href="#search">
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
						<div class='form-row'>
							<div class='col-xs-12 form-group required'>
								<label class='control-label'>Where you are flying from</label>
								<select name="intFrom" id="intFrom" class='form-control'>
									<option value="">Where you are flying from</option>
		    						<?php foreach($places as $place) { ?>
			    					<option value="<?= $place['ApID'] ?>"><?= htmlspecialchars($place['Location']) ?></option>
			    					<?php } ?>
			    				</select>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-xs-12 form-group required'>
								<label class='control-label'>Where you are flying to</label>
								<select name="intTo" id="intTo" class='form-control'>
									<option value="">Where you are flying to</option>
			    					<?php foreach($places as $place) { ?>
			    					<option value="<?= $place['ApID'] ?>"><?= htmlspecialchars($place['Location']) ?></option>
			    					<?php } ?>
			    				</select>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-xs-12 form-group required'>
								<label class='control-label'>Departing Date</label>
								<input autocomplete='off' class='form-control' name="intDepart" id="intDepart" size='20' type='text'>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-xs-12 form-group returnDate required'>
								<label class='control-label'>Returning Date</label>
								<input autocomplete='off' class='form-control' name="intReturn" id="intReturn" size='20' type='text'>
							</div>
						</div>
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
							<div class='col-xs-4 form-group card required'>
								<label class='control-label'>Infant<small> (<2)</small></label>
								<select name="intInfants" id="intInfants" class='form-control'>
				    				<?php for($i=0; $i<=4; $i++) { ?>
				    				<option value="<?= $i ?>"><?= $i ?></option>
				    				<?php } ?>
				    			</select>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-md-12 form-group'>
								<button class='form-control btn btn-primary submit-button' type='submit' name='submit'>Search Flight</button>
							</div>
						</div>
						<div class='form-row'>
							<div class='col-md-12 error form-group hide'>
								<div class='alert-danger alert'>
									Please correct the errors and try again.
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function disablefield()	{
			if(document.getElementById('intTripTypeReturn').checked == true) {
				document.getElementById('intReturn').disabled = false;
			} else {
				document.getElementById('intReturn').disabled = true;
				document.getElementById('intReturn').value = "";
			}

			$errorMessage.addClass('hide');
			$('.has-error').removeClass('has-error');
		}

		$(function() {
			$('form.require-validation').bind('submit', function(e) {
				var $form          = $(e.target).closest('form');
				if(document.getElementById('intTripTypeReturn').checked == false) {
					inputSelector = ['input[id=intDepart]', 'select'].join(', ');
				} else {
					inputSelector = ['input[type=text]', 'select'].join(', ');
				}
				$inputs       = $form.find('.required').find(inputSelector),
				$errorMessage = $form.find('div.error'),
				valid         = true;				

				$errorMessage.addClass('hide');
				$('.has-error').removeClass('has-error');
				$inputs.each(function(i, el) {
					var $input = $(el);
					if ($input.val() === '') {
						$input.parent().addClass('has-error');
						$errorMessage.removeClass('hide');
        				e.preventDefault(); // cancel on first error
				    }
				});
			});
		});

		$(document).ready(function(){
			$("#intDepart").datepicker({
				dateFormat: 'yy-mm-dd',
				numberOfMonths: 2, 
				minDate: 0,
				onSelect: function(selected) {
					$("#intReturn").datepicker("option", "minDate", selected);
					setTimeout(function(){
						if(document.getElementById('intReturn').disabled == false)
							$("#intReturn").datepicker('show');
					});
				}
			});
			$("#intReturn").datepicker({ 
				dateFormat: 'yy-mm-dd',
				numberOfMonths: 2,
				minDate: 0,
				onSelect: function(selected) {
					$("intDepart").datepicker("option", "maxDate", selected)
				}
			});
		});
	</script>
</body>
</html>