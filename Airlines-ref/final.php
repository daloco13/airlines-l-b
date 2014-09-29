<?php
	session_start();
	require_once('connector/db.php');
	$db = new DB();

	$TicketCode = $_SESSION['TicketCode'];
	$queryTransaction = "
		SELECT 
		*, 
		r.RtID, 
		r.Origin, 
		ap.AirportCode AS oAirportCode, 
		ap.Location AS oLocation, 
		ap.Country AS oCountry, 
		r.Destination, 
		ap1.AirportCode AS dAirportCode, 
		ap1.Location AS dLocation, 
		ap1.Country AS dCountry 

		FROM 
		aircrafts ac, 
		aircraftseat acs, 
		airfare af, 
		airport ap, 
		airport ap1, 
		contact_details cd, 
		discount d, 
		flight_schedule fs, 
		passenger p, 
		route r, 
		transactions t 

		WHERE 
		p.Contact = cd.CnID AND 
		t.Passenger = p.PsID AND 
		t.Discount = d.DsID AND 
		t.Flight = fs.FsID AND 
		t.SnID = acs.SnID AND 
		fs.Aircraft = ac.AcID AND 
		fs.Airfare = af.AfID AND 
		af.Route = r.RtID AND 
		r.Origin = ap.ApID AND 
		r.Destination = ap1.ApID AND 
		t.TicketCode = '$TicketCode'

		ORDER BY t.TsID ASC
	";

	echo $queryTransaction;
	$resultAll = $db->getWhere($queryTransaction);
	echo '<pre>';
	print_r($resultAll);
	echo '</pre>';

	/*foreach ($resultAll as $key => $value) {
		foreach ($value as $key) {
			echo $key[$value];
		}
	}*/

        
?>