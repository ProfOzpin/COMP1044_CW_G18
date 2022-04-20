

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('firstname', 'lastname', 'gender', 'year_level');
        $fieldnames = array("First Name", "Last Name", "Gender", "Year Level");
        $i = 0;

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == " " or $_GET[$field] == null){
				$run = false;
				echo "Error: " . $fieldnames[$i] . " field is empty. Please try again \n";
			}
            $i++;

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
  
			$send = "SELECT member_id, firstname, lastname, gender, address, contact, type, year_level, status FROM member WHERE firstname = '$val[0]' AND lastname = '$val[1]' AND gender='$val[2]' AND year_level='$val[3]'";
            $result = $conn->query($send);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Member ID: " . $row["member_id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " - Gender: " . $row["gender"] . " - Address: " . $row['address'] . " - Membership Type: " . $row['type'] . " - Year Level: " . $row['year_level'] . " - Status: " . $row['status'];
                }
            } else {
                echo "0 results";
            }
                

			$conn->close();
		}
	?>
</head>
</html>
