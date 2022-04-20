

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('firstname', 'lastname', 'gender', 'year_level');

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

			$val = array();
            foreach($fields as $field){
                array_push($val, $_GET[$field]);
            }

			$send = "DELETE FROM member WHERE firstname = '$val[0]' AND lastname = '$val[1]' AND gender = '$val[2]' AND year_level = '$val[3]'";

			if ($conn->query($send) === TRUE) {
				echo "Member deleted successfully";
				} else {
				echo "Error deleting Member: " . $conn->error;
				}
				

			$conn->close();
		}
	?>
</head>
</html>
