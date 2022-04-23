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

			$fields = array('borrow_id','borrow_status');
			$fieldnames = array("Borrow ID", "Borrow Status");
			$i = 0;

			foreach($fields as $field){
				if($_GET[$field] == "" or $_GET[$field] == " " or $_GET[$field] == null){
					$run = false;
					echo "<h2 style=\"color:red;\">Error: " . $fieldnames[$i] . " field is empty. Please try again \n</h2>";
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
					echo "<h2 style=\"color:green;\">Borrow record updated successfully</h2>";
				} else {
					echo "<h2 style=\"color:red;\">Error updating borrow details: " . $conn->error . "</h2>";
				}
					

				$conn->close();
			}
		?>
		<br> <button class="button-hover col-3" onclick="location.href='updateborrowingdetails.html'"> Back </button> <br>
	</center>
</body

</html>