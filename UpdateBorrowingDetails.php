<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('borrow_id','borrow_status');
        $fieldnames = array("Borrow ID", "Borrow Status");
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
			$send = "UPDATE borrowdetails SET borrow_status = '$val[1]' WHERE borrow_id = $val[0]";
            $result = $conn->query($send);

            if ($conn->query($send) === TRUE) {
                echo "Borrow Record updated successfully";
            } else {
                echo "Error updating member: " . $conn->error;
            }
                

			$conn->close();
		}
	?>
</head>
</html>
