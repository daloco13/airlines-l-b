<?php
	session_start();
	require_once('connector/db.php');
	$db = new DB();


	$contactID = $db->insertData('contact_details',array('CnID','Email','Mobile','Street','ZipCode','City','Country'),array('', $_SESSION['passengerContacts']['Email'], $_SESSION['passengerContacts']['Mobile'], $_SESSION['passengerContacts']['StreetAddress'], $_SESSION['passengerContacts']['ZipCode'], $_SESSION['passengerContacts']['state'], $_SESSION['passengerContacts']['country']));
	$TicketCode = $db->generateRandomString(8);
	while($db->isUsed($TicketCode)) {
		$TicketCode = $db->generateRandomString(8);
	}

	foreach($_SESSION['passengerDetails'] as $variable) {
		$passengerID = $db->insertData('passenger', array('PsID','Title','Name','BDay','Gender','Type','Contact'), array('', $variable['Title'], $variable['FName'].' '.$variable['LName'], $variable['BDay'], $variable['Gender'], $variable['Type'], $contactID));

		$SeatNumber = $db->availableSeat($_SESSION['FsIDOrigin']);

		if($variable['Type'] == 'Adult') {
			$discountID = 1;
		} else if($variable['Type'] == 'Child') {
			$discountID = 2;
		} else if($variable['Type'] == 'Infant') {
			$discountID = 3;
		}
		$db->insertData('transactions', array('TsID','TicketCode','BookingDate','Passenger','Discount','Flight', 'SnId'), array('', $TicketCode, date('Y-m-d'), $passengerID, $discountID, $_SESSION['FsIDOrigin'], $SeatNumber));
		$aircraftUpdate = "UPDATE aircrafts SET Capacity = Capacity - 1 WHERE AcID = {$_SESSION['departAircraftID']}";
		$db->updateData($aircraftUpdate);
		if($tripType != 'oneway') {
			$db->insertData('transactions', array('TsID','TicketCode','BookingDate','Passenger','Discount','Flight', 'SnId'), array('', $TicketCode, date('Y-m-d'), $passengerID, $discountID, $_SESSION['FsIDDestination'], $SeatNumber));
			$aircraftUpdate = "UPDATE aircrafts SET Capacity = Capacity - 1 WHERE AcID = {$_SESSION['resultAircraftID']}";
			$db->updateData($aircraftUpdate);
		}
	}

	// echo '<pre>';
	// var_dump($_SESSION);
	// echo '</pre>';

	$_SESSION['TicketCode'] = $TicketCode;
	header("location: final.php");
?>