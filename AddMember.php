<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
</head>

<body>
<br><br><br><br><br><br><br><br><br>
	<center>
		<?php

		$run = true;

		$fields = array('firstname', 'lastname', 'gender', 'address', 'contact', 'type', 'year_level', 'status');

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == "" or $_GET[$field] == null){
				$run = false;
				echo "<h2 style=\"color:red;\">Error: " . $field . " field is empty. Please try again \n</h2>";
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

			echo "<h2 style=\"color:green;\">Member has been added successfully!</h2>";

			$conn->close();
		}
		
	?>
	</center>
</body>

</html>