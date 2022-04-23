<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="library.css">
	<script>
    function Return()
    {
        location.href = "updatemember.html";
    }
	</script>
</head>
<body>
<br>
<center><h2 style="color:purple;">Update Database</h2></center>
<br>
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
				<th>Year Level</th>
				<th>Status</th>
			</tr>
		</thead>

<?php
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

$sql = "SELECT * FROM member";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $type = $row["year_level"];
    $status = $row["status"];
	$gender = $row["gender"];

    echo "<tr> <form action='update.php' method='post'>";
    echo "<td> <input type=text name=member_id value='".$row["member_id"]."' readonly></td>";
    echo "<td> <input type=text name=firstName value='".$row["firstname"]."'></td>";
    echo "<td> <input type=text name=lastName value='".$row["lastname"]."'></td>";
    echo "<td> <select name=gender id=gender>
					<option value=$gender>$gender</option>
                    <option value=Male>Male</option>
                    <option value=Female>Female</option>
	</td>";
    echo "<td> <input type=text name=address value='".$row["address"]."'></td>";
    echo "<td> <input type=text name=contact value='".$row["contact"]."'></td>";
    echo "<td> <select name=year_level id=year_level>
					<option value=$type>$type</option>
                    <option value=Faculty>Faculty</option>
                    <option value=First year>First Year</option>
                    <option value=Second year>Second Year</option>
                    <option value=Third year>Third Year</option>
                    <option value=Fourth year>Fourth Year</option>
	</td>";
    echo "<td> <select name=status id=status>
					<option value=$status>$status</option>
                    <option value=Active>Active</option>
                    <option value=Banned>Banned</option>
	</td>";
	echo "<td> <input type=submit></td>";
	echo "</form> </tr>";

    }
} else {
    echo "<h2 style=\"color:red;\">0 results</h2>";
}
    

$conn->close();

?>
</table>
<br> <br>
<button type="button" onclick="location.href='homepageadmin.html'" class="button-hover col-2">Cancel</button>
<br> <br>
</center>
</body>