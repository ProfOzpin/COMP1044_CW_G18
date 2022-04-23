<?php

    
    $servername = "remotemysql.com";
    $username = "aJ61sgaQ7x";
    $password = "ZbKbPfvFYZ";
    $dbname = "aJ61sgaQ7x";
    $conn = new mysqli($servername, $username, $password, $dbname);
  
    $username=$_POST['username'];
    $password=$_POST['psw'];
    $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
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
            header('location:homepageuser.html');
        }
        else
        {
          echo "<br><br><br><br><br>";
          echo "<center>";
          $cssFile = "library.css";
          echo "<link rel='stylesheet' href='" . $cssFile . "'>";
          echo "<h2 style=\"color:red;\">Unsuccessful. Please go back.";
          echo "</center>";
        }
    }   
    
?>
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
        

    <br> <br> <br>
    <button class="button-hover col-3" onclick="Login()">Back </button>
    </center>

</body>

</html>