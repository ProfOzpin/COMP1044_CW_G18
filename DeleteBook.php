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

		$fields = array('book_title', 'author', 'isbn', 'book_pub', 'copyright_year', 'status');

		$i = 0;
		$empty_fields = array();

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == " " or $_GET[$field] == null){
				$i++;
				array_push($empty_fields, $field);
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

			$send = "SELECT book_id FROM book";
			$current_index = 0;
			if($i != 6){
				$send.= " WHERE ";
				foreach($fields as $field){
					
					if(!in_array($field, $empty_fields)){
						if($current_index > 0){
							$send .= " AND ";
						}
						if($field == "copyright_year"){
							$send .= $field . "= " . $_GET[$field];
						} else {
							$send .= $field . "= '" . $_GET[$field] . "'";
						}
						$current_index++;
					}	
					
				}		
			}

			$result = $conn->query($send);
			$book_ids = array();
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    array_push($book_ids, $row['book_id']);
                }
            } else {
                echo "0 results";
            }

			foreach($book_ids as $book_id){
				$send = "DELETE FROM borrowdetails WHERE book_id = " . $book_id;
				if ($conn->query($send) === TRUE) {
					echo "Borrow deleted successfully";
				} else {
					echo "Error deleting book: " . $conn->error;
				}
			}
			
			
			$send = "DELETE FROM book";
			$current_index = 0;
			if($i != 6){
				$send.= " WHERE ";
				foreach($fields as $field){
					
					if(!in_array($field, $empty_fields)){
						if($current_index > 0){
							$send .= " AND ";
						}
						if($field == "copyright_year"){
							$send .= $field . "= " . $_GET[$field];
						} else {
							$send .= $field . "= '" . $_GET[$field] . "'";
						}
						$current_index++;
					}	
					
				}		
			}
			if ($conn->query($send) === TRUE) {
				echo "<h2 style=\"color:green;\">Book deleted successfully!</h2>";
				} else {
				echo "<h2 style=\"color:red;\">Error deleting book: " . $conn->error . "</h2>";
				}
				

			$conn->close();
		}
	?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()">Back </button>
    </center>
</body>

</html>