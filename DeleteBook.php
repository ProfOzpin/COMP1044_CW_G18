

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('book_title', 'author', 'isbn', 'book_pub', 'copyright_year', 'status');

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

			$val[4] = (int) $val[4];
			$send = "DELETE FROM book WHERE book_title = '$val[0]' AND author = '$val[1]' AND isbn = '$val[2]' AND book_pub = '$val[3]' AND copyright_year = '$val[4]' AND status = '$val[5]'";

			if ($conn->query($send) === TRUE) {
				echo "Book deleted successfully";
				} else {
				echo "Error deleting book: " . $conn->error;
				}
				

			$conn->close();
		}
	?>
</head>
</html>
