<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
	<script>
    function Return()
    {
        location.href = "homepageuser.html";
    }
	</script>
</head>

<body>
<br><br><br><br><br><br><br><br><br>
	<center>
	<?php

		$run = true;

		$fields = array('borrow_id');

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == "" or $_GET[$field] == null){
				$run = false;
				echo "<h2>Error: " . $field . " field is empty. Please try again \n</h2>";
			}

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

			$date = date("Y-m-d H:i");

            $val = array();
            foreach($fields as $field){
                array_push($val, $_GET[$field]);
            }

            $send = "UPDATE borrowdetails SET borrow_status = 'returned', date_return = '$date' WHERE borrow_id = $val[0]";
            $result = $conn->query($send);

            if ($conn->query($send) === TRUE) {
                echo "<h2 style=\"color:green;\">Book returned successfully!</h2>";
            } else {
                echo "<h2 style=\"color:red;\">Error returning book: " . $conn->error . "</h2>";
            }

			$conn->close();
		}
	?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()">Back </button>
    </center>
</body>

</html>

