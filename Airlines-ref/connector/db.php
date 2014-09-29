<?php
class DB {
	private $connection;

	public function __construct() {
		try {
			$this->connection = new PDO("mysql:host=localhost;dbname=airlines;","root","");
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getAll($table) {
		$query = "SELECT * FROM {$table}";
		$qresult = $this->connection->query($query);
		$results = $qresult->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}

	public function getWhere($query) {
		$qresult = $this->connection->query($query);
		$results = $qresult->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}

	public function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return strtoupper($randomString);
	}

	public function isUsed($TicketCode) {
		$query = "SELECT COUNT(*) FROM transactions WHERE TicketCode = '{$TicketCode}'";
		$qresult = $this->connection->query($query);
		if($qresult->fetchColumn() < 1) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function availableSeat($flightID) {
		for($i = 1; $i<=40; $i++) {
			$query = "SELECT COUNT(*) FROM transactions WHERE Flight = {$flightID} AND SnID = {$i}";
			$qresult = $this->connection->query($query);
			if($qresult->fetchColumn() <= 0) {
				return $i;
			}
		}
	}

	public function insertData($table,$cols,$values) {
		$query = "";
		$colString = "";
		$valsCounter = 0;

		if(!$cols)
            $colString = ""; //empty string for generic inserts....
        else
        	$colString = $this->__columnParser($cols);

        $query = "INSERT INTO $table $colString VALUES (";
        	foreach($values as $value) {
        		$query .= "?";
        		if($valsCounter <= (count($values)-2))
        			$query .= ",";

        		$valsCounter++;       
        	}
        	$query .= ");";

		echo '<br>'. $query .'<br>';

		try {
			$this->statement = $this->connection->prepare($query);
			$this->statement->execute($values);
			$result = $this->statement->rowCount();
			return $this->connection->lastInsertId();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function updateData($query) {
		try {
			//$this->statement = $this->connection->prepare($query);
			//$this->statement->exec();
			//$result = $this->statement->rowCount();
			$this->connection->exec($query);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	// public function getWhere($table,$cols,$criteria,$values) {

	// 	$colString = "";

	// 	if(!$cols)
 //            $colString = ""; //empty string for generic inserts....
 //        else
 //        	$colString = $this->__columnParser($cols);

 //        $valsCounter = 0;
 //        $query = "SELECT {$criteria} FROM {$table} WHERE $colString = (";
 //        	foreach($values as $value) {
 //        		$query .= "'". $value . "'";
 //        		if($valsCounter <= (count($values)-2))
 //        			$query .= ",";

 //        		$valsCounter++;       
 //        	}
 //        	$query .= ");";

	// 	$query;

	// 	$qresult = $this->connection->query($query);
	// 	$results = $qresult->fetchAll(PDO::FETCH_ASSOC);

	// 	return $results;
	// }

	private function __columnParser($columns) {
		$colString = "(";
		$colsCounter = 0;

		foreach($columns as $column) {
			$colString .= $column;
			if($colsCounter <= (count($columns)-2))
				$colString .= ",";

			$colsCounter++;
		}   

		$colString .= ")";

		return $colString;
	}
}