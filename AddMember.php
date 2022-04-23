<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
	<script>
    function Return()
    {
        location.href = "homepageadmin.html";
    }
	</script>
</head>

<body>
<br><br><br><br><br><br><br><br><br>
	<center>
	<?php

		$run = true;

		$fields = array('firstname', 'lastname', 'gender', 'address', 'contact', 'year_level', 'status');

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == "" or $_GET[$field] == null){
				$run = false;
				echo "Error: " . $field . " field is empty. Please try again \n";
			}

		}

		if($_GET['year_level'] == "Faculty"){
			$type = "Teacher";
		} else {
			$type = "Student";
		}
		if($run == true){
			$servername = "remotemysql.com";
			$username = "aJ61sgaQ7x";
			$password = "ZbKbPfvFYZ";
			$dbname = "aJ61sgaQ7x";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			
			$send = $conn->prepare("INSERT INTO member(firstname, lastname, gender, address, contact, type, year_level, status) VALUES (?,?,?,?,?,?,?,?)");
			$send->bind_param("ssssssss", $_GET['firstname'], $_GET['lastname'], $_GET['gender'], $_GET['address'], $_GET['contact'], $type, $_GET['year_level'], $_GET['status']);
			$send->execute();

			echo "Added Item";

			$conn->close();
		}
		
	?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()"> Go Back </button>
    </center>
</body>

</html>
