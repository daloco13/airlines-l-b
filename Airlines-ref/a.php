<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>
	<div class='container'>
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
					<h5 class="summary-title">Total Passengers: <span class='summary-right'></span></h5>
					<div class="summary-divider"></div>
					<div class=""><h6><span class='summary-name'>Adult x <span id="intAdult"></span></span><span class='summary-right'><span id="adultDep"></span> Php(Dep) </span></h6></div>
					<div class=""><h6><span class='summary-name'>Child (2-11) x <span id="intChild"></span></span><span class='summary-right'><span id="childDep"></span> Php(Dep) </span></h6></div>
					<div class=""><h6><span class='summary-name'>Infant  x <span id="intInfant"></span></span><span class='summary-right'><span id="infantDep"></span> Php(Dep)</span></h6></div>
					<div class="summary-divider"></div>

					<h4 class='summary-heading'>Total: <span class='summary-right'><span id="total"></span> Php</span></h4>
				</div>


				<div class="col-xs-12">
					<div class="panel panel-danger">
						<div class="panel-heading clickable">
							<h3 class="panel-title">Passenger Information</h3>
							<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
						</div>
						<div class="panel-body">
							<div class="col-xs-12"><h4>Contact Information</h4></div>
							<div class="col-xs-3">
								Address:
							</div>
							<div class="col-xs-9">
								184 Camarin Road Novaliches North, Las Pinas<br>
								1422 METRO MANILA, PHILIPPINES
							</div>
							<div class="col-xs-12"><h4>Contact Information</h4></div>
							<div class="col-xs-3">
								Address:
							</div>
							<div class="col-xs-9">
								184 Camarin Road Novaliches North, Las Pinas<br>
								1422 METRO MANILA, PHILIPPINES
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class='col-md-8'>
				<div class='col-xs-12 summary'>
					<h4 class='summary-heading'>Trip Summary</h4>
					<h5 class='summary-title'>Departing</h5>
					<h6><span class='summary-name'>Flight:</span>&nbsp;&nbsp;<span id='oFlight'></span></h6>
					<h6><span class='summary-name'>Depart:</span>&nbsp;&nbsp;<span id='oDepart'></span></h6>
					<h6><span class='summary-name'>Departure:</span>&nbsp;&nbsp;<span id='oDeparture'></span></h6>
					<h6><span class='summary-name'>Arrive:</span>&nbsp;&nbsp;<span id='oArrive'></span></h6>
					<h6><span class='summary-name'>Arrival:</span>&nbsp;&nbsp;<span id='oArrival'></span></h6>
					<div class="summary-divider"></div>
					<h5 class="summary-title">Total Passengers: <span class='summary-right'></span></h5>
					<div class="summary-divider"></div>
					<div class=""><h6><span class='summary-name'>Adult x <span id="intAdult"></span></span><span class='summary-right'><span id="adultDep"></span> Php(Dep) </span></h6></div>
					<div class=""><h6><span class='summary-name'>Child (2-11) x <span id="intChild"></span></span><span class='summary-right'><span id="childDep"></span> Php(Dep) </span></h6></div>
					<div class=""><h6><span class='summary-name'>Infant  x <span id="intInfant"></span></span><span class='summary-right'><span id="infantDep"></span> Php(Dep)</span></h6></div>
					<div class="summary-divider"></div>

					<h4 class='summary-heading'>Total: <span class='summary-right'><span id="total"></span> Php</span></h4>
				</div>


				<div class="col-xs-12">
					<div class="panel panel-danger">
						<div class="panel-heading clickable">
							<h3 class="panel-title">Passenger Information</h3>
							<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
						</div>
						<div class="panel-body">
							<div class="col-xs-12"><h4>Contact Information</h4></div>
							<div class="col-xs-3">
								Address:
							</div>
							<div class="col-xs-9">
								184 Camarin Road Novaliches North, Las Pinas<br>
								1422 METRO MANILA, PHILIPPINES
							</div>
							<div class="col-xs-12"><h4>Contact Information</h4></div>
							<div class="col-xs-3">
								Address:
							</div>
							<div class="col-xs-9">
								184 Camarin Road Novaliches North, Las Pinas<br>
								1422 METRO MANILA, PHILIPPINES
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Agreements</h3>
						</div>
						<div class="panel-body">
							<div class="tab-content table-responsive">
								<div class="form-row">
									<ul>
										<li>Fuck.</li>
										<li>Shit.</li>
										<li>Motherfucker.</li>
										<li>Bullshit.</li>
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
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Agreements</h3>
						</div>
						<div class="panel-body">
							<div class="tab-content table-responsive">
								<div class="form-row">
									<ul>
										<li>Fuck.</li>
										<li>Shit.</li>
										<li>Motherfucker.</li>
										<li>Bullshit.</li>
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
			
		</div>
	</div>
</body>
</html>

