<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
</head>

<body>
<br>
<center><h2 style="color:gold;">Search Results</h2></center>
<br><br>
	<center>
	<table class="table">
		<thead>
			<tr>
				<th>Member ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Contact</th>
				<th>Type</th>
				<th>Year Level</th>
				<th>Status</th>
			</tr>
		</thead>
	
		<?php

			$run = true;

			$fields = array('firstname', 'lastname', 'gender', 'year_level');
			$fieldnames = array("First Name", "Last Name", "Gender", "Year Level");
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

				$send = "SELECT member_id, firstname, lastname, gender, address, contact, type, year_level, status FROM member";
				$current_index = 0;
				if($i != 4){
					$send.= " WHERE ";
					foreach($fields as $field){
						
						if(!in_array($field, $empty_fields)){
							if($current_index > 0){
								$send .= " AND ";
							}
							$send .= $field . "= '" . $_GET[$field] . "'";
							$current_index++;
						}	
						
					}		
				}

				$result = $conn->query($send);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
		?>
					<tr>
						<td> <?php echo $row["member_id"];?> </td>
						<td> <?php echo $row["firstname"];?> </td>
						<td> <?php echo $row["lastname"];?> </td>
						<td> <?php echo $row["gender"];?> </td>
						<td> <?php echo $row["address"];?> </td>
						<td> <?php echo $row["contact"];?> </td>
						<td> <?php echo $row["type"];?> </td>
						<td> <?php echo $row["year_level"];?> </td>
						<td> <?php echo $row["status"];?> </td>
					</tr>
		<?php
					}
				} else {
					echo "<h2 style=\"color:red;\">0 results</h2>";
				}
					

				$conn->close();
			}
		?>
		</table>
	<br> <br>
	<button class="button-hover col-3" onclick="location.href='searchmember.html'"> Back </button>
	<br> <br>
	</center>
</body>

</html>