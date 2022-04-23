<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="library.css">
	<script>
    function Return()
    {
        location.href = "updatemember.php";
    }
	</script>
</head>
<body>
    <center>
        <br> <br> <br> <br> <br> <br> <br> <br> <br>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sqldatabase";
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
    echo "Error updating record: " . $conn->error;
    }
    $conn->close();
?>
    
<button type="button" onclick="location.href='UpdateMember.php'" class="button-hover col-3">Back</button>
<br> <br>
</center>
</body>