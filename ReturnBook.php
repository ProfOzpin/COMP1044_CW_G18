

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('borrow_id');

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

			$date = date("Y-m-d H:i");

            $val = array();
            foreach($fields as $field){
                array_push($val, $_GET[$field]);
            }

            $send = "UPDATE borrowdetails SET borrow_status = 'returned', date_return = '$date' WHERE borrow_id = $val[0]";
            $result = $conn->query($send);

            if ($conn->query($send) === TRUE) {
                echo "Book Returned Successfully";
            } else {
                echo "Error returning book: " . $conn->error;
            }

			$conn->close();
		}
	?>
</head>
</html>
