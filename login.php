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
    <center>
        <br><br><br><br><br><br><br><br><br><br>
    <?php

    session_start();

    $conn = mysqli_connect("localhost","root","","sqldatabase");
  
    $username=$_POST['username'];
    $password=$_POST['psw'];
    $query="select * from users where username='$username' && password='$password'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    
    if($username=="admin" && $password=="admin")
    {
        header('location:homepageadmin.html');
    }
    else 
    {
        if($count > 0)
        {
            echo "Done";
            header('location:homepageuser.html');
        }
        else
        {
            echo "<h2 style=\"color:red;\">Unsuccessful. Please go back.";
        }
    }   
    
?>
    <br> <br> <br>
    <button class="button-hover col-3" onclick="Login()"> Go Back </button>
    </center>

</body>

</html>