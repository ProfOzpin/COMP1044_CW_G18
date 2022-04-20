

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('firstname', 'lastname', 'gender', 'address', 'contact', 'type', 'year_level', 'status');

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == "" or $_GET[$field] == null){
				$run = false;
				echo "Error: " . $field . " field is empty. Please try again \n";
			}

		}

		if($run == true){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "sqldatabase";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			
			$send = $conn->prepare("INSERT INTO member(firstname, lastname, gender, address, contact, type, year_level, status) VALUES (?,?,?,?,?,?,?,?)");
			$send->bind_param("ssssssss", $_GET['firstname'], $_GET['lastname'], $_GET['gender'], $_GET['address'], $_GET['contact'], $_GET['type'], $_GET['year_level'], $_GET['status']);
			$send->execute();

			echo "Added Item";

			$conn->close();
		}
		
	?>
</head>
</html>
