<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="library.css">
    <script>
        function Login()
        {
            location.href = "login.html";
        }
    </script>
</head>

<body>
<br><br><br><br><br><br><br><br><br>
	<center>
		<?php

        $servername = "remotemysql.com";
        $username = "aJ61sgaQ7x";
        $password = "ZbKbPfvFYZ";
        $dbname = "aJ61sgaQ7x";
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
		$sql = "INSERT INTO users (username,
			password, firstname, lastname) VALUES ('$username', '$password', '$first_name', '$last_name')";

        if ($conn->query($sql) === TRUE) 
        {
        echo "<h2 style=\"color:green;\">Account created successfully!</h2>";
        } 
        else 
        {
        echo "<h2>Error: " . $sql . "<br>" . $conn->error . "</h2>";
        }
    
		// Close connection
		$conn->close();
		?>
	</center>
    <br> <br> <br> <br> <br>
    <center>
    
        <button class="button-hover col-3" onclick="Login()"> Login </button>
    
    </center>
</body>

</html>
