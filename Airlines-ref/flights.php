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
        
        $queryDepart = "SELECT *, r.RtID, r.Origin, ap.AirportCode AS oAirportCode, ap.Location AS oLocation, ap.Country AS oCountry, r.Destination, ap1.AirportCode AS dAirportCode, ap1.Location AS dLocation, ap1.Country AS dCountry FROM Flight_Schedule fs, AirFare af, Route r, Aircrafts ac, airport ap, airport ap1 WHERE fs.AirFare = af.AfID AND fs.AirCraft = ac.AcID AND af.Route = r.RtID AND r.Origin = ap.ApID AND  r.Destination = ap1.ApID AND r.Origin = ".$_SESSION['intFrom']." AND r.Destination = ".$_SESSION['intTo']." AND ac.Capacity >= ".$_SESSION['totalPassenger']." AND fs.FlightDate = '".$_SESSION['intDepart']."'";
        $resultsDepart = $db->getWhere($queryDepart);
        if($tripType != 'oneway') {
            $queryReturn = "SELECT *, r.RtID, r.Origin, ap.AirportCode AS oAirportCode, ap.Location AS oLocation, ap.Country AS oCountry, r.Destination, ap1.AirportCode AS dAirportCode, ap1.Location AS dLocation, ap1.Country AS dCountry FROM Flight_Schedule fs, AirFare af, Route r, Aircrafts ac, airport ap, airport ap1 WHERE fs.AirFare = af.AfID AND fs.AirCraft = ac.AcID AND af.Route = r.RtID AND r.Origin = ap.ApID AND  r.Destination = ap1.ApID AND r.Origin = ".$_SESSION['intTo']." AND r.Destination = ".$_SESSION['intFrom']." AND ac.Capacity >= ".$_SESSION['totalPassenger']." AND fs.FlightDate = '".$_SESSION['intReturn']."'";
            $resultsReturn = $db->getWhere($queryReturn);
        }
        
        // echo '<pre>';
        // print_r($resultsDepart);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($resultsReturn);
        // echo '</pre>';
        
        
        

        if(isset($_POST['submit'])) {
            if(isset($_POST['selectplaneDepart'])) {
                $FsIDOrigin = explode(';',$_POST['selectplaneDepart']);
                $_SESSION['FsIDOrigin'] = $FsIDOrigin[0];
            }

            if(isset($_POST['selectplaneReturn'])) {
                $FsIDDestination = explode(';',$_POST['selectplaneReturn']);
                $_SESSION['FsIDDestination'] = $FsIDDestination[0];
            }
            header("location: passengers.php#search");
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
                        
    					<h5 class='summary-title'>Departing</h5>
    					<h6><span class='summary-name'>Flight:</span>&nbsp;&nbsp;<span id='oFlight'></span></h6>
    					<h6><span class='summary-name'>Depart:</span>&nbsp;&nbsp;<span id='oDepart'></span></h6>
    					<h6><span class='summary-name'>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'></span></h6>
    					<h6><span class='summary-name'>Arrive:</span>&nbsp;&nbsp;<span id='oArrive'></span></h6>
    					<h6><span class='summary-name'>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'></span></h6>
                        <div class="summary-divider"></div>
                        <?php
                            if($tripType != 'oneway') {
                                echo "<h5 class='summary-title'>Returning</h5>";
                                echo "<h6><span class='summary-name'>Flight:</span>&nbsp;&nbsp;<span id='dFlight'></span></h6>";
                                echo "<h6><span class='summary-name'>Depart:</span>&nbsp;&nbsp;<span id='dDepart'></span></h6>";
                                echo "<h6><span class='summary-name'>Departure:</span>&nbsp;&nbsp;<span id='dDeparture'></span></h6>";
                                echo "<h6><span class='summary-name'>Arrive:</span>&nbsp;&nbsp;<span id='dArrive'></span></h6>";
                                echo "<h6><span class='summary-name'>Arrival:</span>&nbsp;&nbsp;<span id='dArrival'></span></h6>";
                                echo "<div class='summary-divider'></div>";
                            }
                        ?>

                        <h5 class="summary-title">Total Passengers: <span class='summary-right'><?php echo $_SESSION['totalPassenger']; ?></span></h5>
    					<div class="summary-divider"></div>
    					<div class="<?php if($_SESSION['adult'] <= 0) echo "hide"; ?>"><h6><span class='summary-name'>Adult x <span id="intAdult"><?php echo $_SESSION['adult']; ?></span></span><span class='summary-right'><span id="adultDep">0</span> Php(Dep) <?php if($tripType != 'oneway') echo ' + <span id="adultRet">0</span> Php(Ret)'; ?></span></h6></div>
    					<div class="<?php if($_SESSION['child'] <= 0) echo "hide"; ?>"><h6><span class='summary-name'>Child (2-11) x <span id="intChild"><?php echo $_SESSION['child']; ?></span></span><span class='summary-right'><span id="childDep">0</span> Php(Dep) <?php if($tripType != 'oneway') echo '+ <span id="childRet">0</span> Php(Ret)'; ?></span></h6></div>
    					<div class="<?php if($_SESSION['infant'] <= 0) echo "hide"; ?>"><h6><span class='summary-name'>Infant (<2) x <span id="intInfant"><?php echo $_SESSION['infant']; ?></span></span><span class='summary-right'><span id="infantDep">0</span> Php(Dep) <?php if($tripType != 'oneway') echo '+ <span id="infantRet">0</span> Php(Ret)'; ?></span></h6></div>
    					<div class="summary-divider"></div>
                        <h4 class='summary-heading'>Total: <span class='summary-right'><span id="total">0</span> Php</span></h4>
    				</div>
    			</div>
    			<div class='col-md-8'>
    				<div class="col-xs-12">
    					<ul class="nav nav-pills nav-justified thumbnail">
    						<li><a href="index.php#search">
    							<h4 class="list-group-item-heading">Search</h4>
    							<p class="list-group-item-text">First step</p>
    						</a></li>
    						<li class="active"><a href="#search">
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
    					<div class="col-md-12">
                            <h2>Departing Trip</h2>
    						<div class="input-group">
	    						<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
	    						<input class="form-control" id="departing" name="q" placeholder="Search for Departing">
	    						<span class="input-group-btn">
	    							<a href="#search" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></a>
	    						</span>
	    					</div>
                            <br>
    						<table class="table table-list-searcha">
    							<thead>
    								<tr>
    									<th><h5>Flight</h5></th>
    									<th><h5>Depart</h5></th>
    									<th><h5>Arive</h5></th>
    									<th><h5>Trip Duration</h5></th>
                                        <th><h5>Price</h5></th>
    									<th><h5>Available</h5></th>
    								</tr>
    							</thead>
    							<tbody>
                                    <?php 
                                        foreach($resultsDepart as $v) {
                                            $tripDuration = sprintf("%02s", floor((strtotime($v['Arrival'])-strtotime($v['Departure']))/3600));
            								echo '<tr>';
            									echo '<td>'.$v['AcName'].'</td>';
            									echo '<td>'.$v['oAirportCode'] .' '. date('h:i', strtotime($v['Departure'])) . '</td>';
            									echo '<td>'.$v['dAirportCode'] .' '. date('h:i', strtotime($v['Arrival'])) . '</td>';
            									echo '<td>'.$tripDuration.' Hour/s</td>';
                                                echo '<td>PHP '.$v['Fare'].'</td>';
            									echo '<td class="select-radio">';
            										echo '<input type="radio" name="selectplaneDepart" id="selectplaneDepart" value="'.$v['FsID'].';'.$v['AcName'].';'.$v['oLocation'].';'.$v['oCountry'].';'.$v['Departure'].';'.$v['dLocation'].';'.$v['dCountry'].';'.$v['Arrival'].';'.$v['Fare'].'" onclick="writeResultDepart(value); " />';
            										echo '&nbsp;<label class="">'.$v['Capacity'].' seats left</label>';
            									echo '</td>';
            								echo '</tr>';
                                        }
                                    ?>
    							</tbody>
    						</table>
    					</div>
                        <div class="col-md-12"><br></div>

    					<div class="col-md-12 <?php if($tripType == 'oneway') echo 'hide'; ?>">
                            <h2>Returning Trip</h2>
    						<!---------------------------------->
    						<div class="input-group">
	    						<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
	    						<input class="form-control" id="returning" name="q" placeholder="Search for Returning">
	    						<span class="input-group-btn">
	    							<a href="#search" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></a>
	    						</span>
	    					</div>
                            <br>
    						<table class="table table-list-searchb">
    							<thead>
    								<tr>
    									<th><h5>Flight</h5></th>
    									<th><h5>Depart</h5></th>
    									<th><h5>Arive</h5></th>
    									<th><h5>Trip Duration</h5></th>
                                        <th><h5>Price</h5></th>
    									<th><h5>Available</h5></th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php 
                                        foreach($resultsReturn as $v) {
                                            $tripDuration = sprintf("%02s", floor((strtotime($v['Arrival'])-strtotime($v['Departure']))/3600));
                                            echo '<tr>';                               
                                            echo '<tr>';
                                                echo '<td>'.$v['AcName'].'</td>';
                                                echo '<td>'.$v['oAirportCode'] .' '. date('h:i', strtotime($v['Departure'])) . '</td>';
                                                echo '<td>'.$v['dAirportCode'] .' '. date('h:i', strtotime($v['Arrival'])) . '</td>';
                                                echo '<td>'.$tripDuration.' Hour/s</td>';
                                                echo '<td>PHP '.$v['Fare'].'</td>';
                                                echo '<td class="select-radio">';
                                                    echo '<input type="radio" name="selectplaneReturn" id="selectplaneReturn" value="'.$v['FsID'].';'.$v['AcName'].';'.$v['oLocation'].';'.$v['oCountry'].';'.$v['Departure'].';'.$v['dLocation'].';'.$v['dCountry'].';'.$v['Arrival'].';'.$v['Fare'].'" onclick="writeResultReturn(value); " />';
                                                    echo '&nbsp;<label class="">'.$v['Capacity'].' seats left</label>';
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
    							</tbody>
    						</table>
                        </div>



                        <div class="col-md-12">
	    					<div class='form-row'>
	    						<div class='col-md-12 form-group'>
	    							<button class='form-control btn btn-primary submit-button' type='submit' name='submit'>Select Flight</button>
	    						</div>
	    					</div>
	    					<div class='form-row'>
	    						<div class='col-md-12 error form-group hide'>
	    							<div class='alert-danger alert'>
	    								Please choose the available flight and try again.
	    							</div>
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
                if(!$("input[name=selectplaneDepart]:checked").val()) {
                    $('.hide').removeClass('hide');
                    e.preventDefault();
                }


                <?php
                    if($tripType != 'oneway') {
                        echo "if(!$('input[name=selectplaneReturn]:checked').val()) {
                            $('.hide').removeClass('hide');
                            e.preventDefault();}";
                    }
                ?>
			});
		});

		function searchbar(e) {
			var activeSystemClass = $('.list-group-item.active');
		    //something is entered in search form
		    $(e).keyup( function() {
		       var that = this;

		        if(e === '#departing') {
		        	var tableBody = $('.table-list-searcha tbody');
		        	var tableRowsClass = $('.table-list-searcha tbody tr');

		        	$('.search-sfa').remove();
			        tableRowsClass.each( function(i, val) {
			        
			            //Lower text for case insensitive
			            var rowText = $(val).text().toLowerCase();
			            var inputText = $(that).val().toLowerCase();
			            if(inputText != '') {
			                $('.search-query-sfa').remove();
			                tableBody.prepend('<tr class="search-query-sfa"><td colspan="6"><strong>Searching for: "'
			                    + $(that).val()
			                    + '"</strong></td></tr>');
			            } else {
			                $('.search-query-sfa').remove();
			            }

			            if( rowText.indexOf( inputText ) == -1 ) {
			                //hide rows
			                tableRowsClass.eq(i).hide();
			            } else {
			                $('.search-sfa').remove();
			                tableRowsClass.eq(i).show();
			            }
			        });
			        //all tr elements are hidden
			        if(tableRowsClass.children(':visible').length == 0) {
			            tableBody.append('<tr class="search-sfa"><td class="text-muted" colspan="6">No entries found.</td></tr>');
			        }
		        } else {
		        	var tableBody = $('.table-list-searchb tbody');
		        	var tableRowsClass = $('.table-list-searchb tbody tr');

		        	$('.search-sfb').remove();
			        tableRowsClass.each( function(i, val) {
			        
			            //Lower text for case insensitive
			            var rowText = $(val).text().toLowerCase();
			            var inputText = $(that).val().toLowerCase();
			            if(inputText != '') {
			                $('.search-query-sfb').remove();
			                tableBody.prepend('<tr class="search-query-sfb"><td colspan="6"><strong>Searching for: "'
			                    + $(that).val()
			                    + '"</strong></td></tr>');
			            } else {
			                $('.search-query-sfb').remove();
			            }

			            if( rowText.indexOf( inputText ) == -1 ) {
			                //hide rows
			                tableRowsClass.eq(i).hide();
			            } else {
			                $('.search-sfb').remove();
			                tableRowsClass.eq(i).show();
			            }
			        });
			        //all tr elements are hidden
			        if(tableRowsClass.children(':visible').length == 0) {
			            tableBody.append('<tr class="search-sfb"><td class="text-muted" colspan="6">No entries found.</td></tr>');
			        }
		        }		        
		    });
		}

        function writeResultDepart(text) {
            var data = text.split(';');
            $("#oFlight").html(data[1]);
            $("#oDepart").html(data[2] + ', ' + data[3]);
            $("#oDeparture").html(data[4]);
            $("#oArrive").html(data[5] + ', ' + data[6]);
            $("#oArrival").html(data[7]);

            var adult = (<?php echo $_SESSION['adult'] ?> * data[8]).toFixed(0);
            var child = ((<?php echo $_SESSION['child'] ?> * data[8]) * 0.7).toFixed(0);
            var infant = ((<?php echo $_SESSION['infant'] ?> * data[8]) * 0.6).toFixed(0);

            $("#adultDep").html(adult);
            $("#childDep").html(child);
            $("#infantDep").html(infant);
            var total = parseInt($("#adultDep").html()) + parseInt($("#childDep").html()) + parseInt($("#infantDep").html())<?php if($tripType != 'oneway') echo ' + parseInt($("#adultRet").html()) + parseInt($("#childRet").html()) + parseInt($("#infantRet").html())'; ?>;
            $("#total").html(total);
        }

        function writeResultReturn(text) {
            var data = text.split(';');
            $("#dFlight").html(data[1]);
            $("#dDepart").html(data[2] + ', ' + data[3]);
            $("#dDeparture").html(data[4]);
            $("#dArrive").html(data[5] + ', ' + data[6]);
            $("#dArrival").html(data[7]);

            var adult = (<?php echo $_SESSION['adult'] ?> * data[8]).toFixed(0);
            var child = ((<?php echo $_SESSION['child'] ?> * data[8]) * 0.7).toFixed(0);
            var infant = ((<?php echo $_SESSION['infant'] ?> * data[8]) * 0.6).toFixed(0);
            $("#adultRet").html(adult);
            $("#childRet").html(child);
            $("#infantRet").html(infant);
            var total = parseInt($("#adultDep").html()) + parseInt($("#childDep").html()) + parseInt($("#infantDep").html()) + parseInt($("#adultRet").html()) + parseInt($("#childRet").html()) + parseInt($("#infantRet").html());
            $("#total").html(total);
        }

		$(document).ready(function(){
			searchbar('#departing');
            <?php 
                if($tripType != 'oneway') 
                    echo "searchbar('#returning');";
            ?>
    	});
	</script>
</body>
</html>