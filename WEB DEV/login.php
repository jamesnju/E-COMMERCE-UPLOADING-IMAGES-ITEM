<?php
    require_once 'connection.php';
    
    if (isset($_POST["submit"])) {
        $usernameemail = $_POST["usernameemail"];
        $password = $_POST["password"];
        $result = mysqli_query($conn, "SELECT * FROM regi WHERE username = '$usernameemail' OR email = '$usernameemail'");
        $row = mysqli_fetch_assoc($result);
    
        if (mysqli_num_rows($result) > 0) {
            if ($password == $row["password"]) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                header("Location: products.php");
            } else {
                echo "<script> alert('Wrong Password or username'); </script>";
            }
        }
    }
    
    session_destroy();//destroys the session you cant go back
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>LOGIN</title>
</head>
<body>
<form class="form" action="" method="post">
    <label for="username"><h3>USERNAME OR EMAIL </h3></label><br/>
    <input type="text" name="usernameemail" maxlength="60" id="usernameemail" placeholder="usernameemail" required autofocus/><br>
    <label for="passord"><h3>PASSWORD</h3></label><br>
    <input type="password" name="password" maxlength="20" id="password" required /><br>
    <button type="submit" name="submit">LOGIN</button>
    <a href="signup.php">Don't have an account, Click here to Register</a>
</form>    
</body>
</html>