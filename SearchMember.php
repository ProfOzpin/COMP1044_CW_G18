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

			$fields = array('firstname', 'lastname', 'gender', 'year_level');
			$fieldnames = array("First Name", "Last Name", "Gender", "Year Level");
			$i = 0;

			$i = 0;
			$empty_fields = array();

			foreach($fields as $field){
				if($_GET[$field] == "" or $_GET[$field] == " " or $_GET[$field] == null){
					$i++;
					array_push($empty_fields, $field);
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

				$send = "SELECT member_id, firstname, lastname, gender, address, contact, type, year_level, status FROM member";
				$current_index = 0;
				if($i != 4){
					$send.= " WHERE ";
					foreach($fields as $field){
						
						if(!in_array($field, $empty_fields)){
							if($current_index > 0){
								$send .= " AND ";
							}
							$send .= $field . "= '" . $_GET[$field] . "'";
							$current_index++;
						}	
						
					}		
				}

				$result = $conn->query($send);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<h2 style=\"color:green;\">Member ID: " . $row["member_id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " - Gender: " . $row["gender"] . " - Address: " . $row['address'] . " - Membership Type: " . $row['type'] . " - Year Level: " . $row['year_level'] . " - Status: " . $row['status'] . "<br></h2>";
					}
				} else {
					echo "<h2 style=\"color:green;\">0 results</h2>";
				}
					

				$conn->close();
			}
		?>
	</center>
</body>

</html>