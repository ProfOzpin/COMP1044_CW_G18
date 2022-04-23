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

		$fields = array('book_id', 'member_id', 'due_date');

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == "" or $_GET[$field] == null){
				$run = false;
				echo "Error: " . $field . " field is empty. Please try again \n";
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

			$date = date("d/m/Y H:i");

            $val = array();
            foreach($fields as $field){
                array_push($val, $_GET[$field]);
            }

            $send = "SELECT book_id FROM borrowdetails WHERE book_id = $val[0] AND borrow_status = 'pending'";
            $result = $conn->query($send);
            $index = 0;

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $index++;
                }
            }
            
            $send = "SELECT book_copies FROM book WHERE book_id = $val[0]";
            $result = $conn->query($send);
            $number_of_copies = 0;

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $number_of_copies = $row['book_copies'];
                }
            }

            if($index < (int) $number_of_copies){
                $send = $conn->prepare("INSERT INTO borrow(member_id, date_borrow, due_date) VALUES (?,?,?)");
                $send->bind_param("iss", $_GET['member_id'], $date, $_GET['due_date']);
                $send->execute();
    
                $send = "SELECT MAX(borrow_id) AS current_index FROM borrow";
                $result = $conn->query($send);
                $current_index = 0;
    
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $current_index = (int) $row['current_index'];
                    }
                }
                
                $status = "pending";
                $date_return = NULL;
                
    
                $send = $conn->prepare("INSERT INTO borrowdetails(book_id, borrow_id, borrow_status, date_return) VALUES (?,?,?,?)");
                $send->bind_param("iiss", $_GET['book_id'], $current_index, $status, $date_return);
                $send->execute();
    
                echo "<h2 style=\"color:green;\">Borrowed Book! Your Borrow ID is " . $current_index . "</h2>";  
            } else {
                echo "<h2 style=\"color:red;\">Cannot borrow book, all copies are taken!</h2>";
            }
			
			

			$conn->close();
		}
	?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()">Back </button>
    </center>
</body>

</html>

