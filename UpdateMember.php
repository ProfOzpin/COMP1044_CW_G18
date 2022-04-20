

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('member_id','firstname', 'lastname', 'address', 'contact', 'type', 'status', 'gender', 'year_level');
        $fieldnames = array("Member ID", "First Name", "Last Name", "Address", "Contact", "Type", "Status", "Gender", "Year Level");
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
  
            $val[0] = (int) $val[0];
			$send = "UPDATE member SET firstname = '$val[1]', lastname = '$val[2]', address = '$val[3]', contact = '$val[4]', type = '$val[5]', status = '$val[6]', gender = '$val[7]', year_level = '$val[8]' WHERE member_id = $val[0]";
            $result = $conn->query($send);

            if ($conn->query($send) === TRUE) {
                echo "Member updated successfully";
            } else {
                echo "Error updating member: " . $conn->error;
            }
                

			$conn->close();
		}
	?>
</head>
</html>
