<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
	<script>
    function Return()
    {
        location.href = "UpdateMember.php";
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

if($_POST['year_level'] == "Faculty"){
    $type = "Teacher";
} else {
    $type = "Student";
}

$sql = "UPDATE member SET firstname='$_POST[firstName]', lastname='$_POST[lastName]', gender='$_POST[gender]', address='$_POST[address]', contact='$_POST[contact]', type='$type', year_level='$_POST[year_level]', status='$_POST[status]' WHERE member_id='$_POST[member_id]'";
if ($conn->query($sql) === TRUE) {
    echo "<h2 style=\"color:green;\">Record(s) updated successfully!</h2>";
    } else {
    echo "<h2 style=\"color:red;\">Error updating record: " . $conn->error . "</h2>";
    }
    $conn->close();
?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()">Back </button>
    </center>
</body>

</html>

