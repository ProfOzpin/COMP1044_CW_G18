<!DOCTYPE html>
<html>

<head>
	<title>Insert</title>
</head>

<body>
	<center>
		<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sqldatabase";
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		// Check connection
		if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
		
		// Taking all 5 values from the form data(input)
		$first_name = $_REQUEST['firstName'];
		$last_name = $_REQUEST['lastName'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['psw'];
		
		
		// Performing insert query execution
		// here our table name is college
		$sql = "INSERT INTO users VALUES ('','$username',
			'$password','$first_name','$last_name')";

        if ($conn->query($sql) === TRUE) 
        {
        echo "New record created successfully";
        } 
        else 
        {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
		// Close connection
		$conn->close();
		?>
	</center>
</body>

</html>
