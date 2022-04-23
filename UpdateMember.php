
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

		$fields = array('member_id','firstname', 'lastname', 'address', 'contact', 'type', 'status', 'gender', 'year_level');
        $fieldnames = array("Member ID", "First Name", "Last Name", "Address", "Contact", "Type", "Status", "Gender", "Year Level");
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
			$member_id = $_GET['member_id'];

            $send = "UPDATE member";
			$current_index = 0;
			if($i != 6){
				$send.= " SET ";
				foreach($fields as $field){
					
					if(!in_array($field, $empty_fields) and $field != "member_id"){
						if($current_index > 0){
							$send .= ", ";
						}
						$send .= $field . "= '" . $_GET[$field] . "'";
						$current_index++;
					}	
					
				}		
			}
			$send .= " WHERE member_id = $member_id" ;

			if ($conn->query($send) === TRUE) {
				echo "<h2 style=\"color:green;\">Member updated successfully</h2>";
				} else {
				echo "<h2 style=\"color:red;\">Error updating member: " . $conn->error . "</h2>";
				}
				

			$conn->close();
		}
	?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()"> Go Back </button>
    </center>
</body>

</html>
