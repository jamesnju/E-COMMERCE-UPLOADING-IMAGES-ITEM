<?php
require 'connection.php';


if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM regi WHERE username = '$username' OR email ='$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> alert('username or email has been taken'); </script>";
    }
    else{
        if($password == $confirmpassword){
            $query = "INSERT INTO regi VALUES('', '$name', '$username', '$email', '$password')";
            mysqli_query($conn,$query);
            echo
            "<script> alert('Registration success'); </script>";
        }
        else{
            echo
            "<script> alert('Password does not match'); </script>";

        }
    }
          
    
}   


?>


<!DOCTYPE html>
<html>
    <head>
        <title>SIGN UP PAGE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <form class="form" action="" method="post">
            <label for="name"> NAME</label>
            <input type="text" name="name" maxlength="15" placeholder="name" id="name" required autofocus/>
            <label for="username">ENTER USERNAME</label>
            <input type="text" name="username" maxlength="15" id="username" placeholder="username" required/>
            <label for="email"> EMAIL</label>
            <input type="email" name="email" placeholder="email" id="email" maxlength="50" required/>
            <label for="passord">SET PASSWORD</label>
            <input type="password" name="password" maxlength="10" id="password" required />
            <label>CONFIRM PASSWORD</label>
            <input type="password" name="confirmpassword" maxlength="10" id="confirmpassword" required/>
            <div>
                
                <button type="submit" name="submit" value="Register" >REGISTER</button>
                <button type="reset" name="reset" value="refresh">Reset</button>
                <button type="submit" name="submit" value="forgottpassword">forgottpassword</button>
                <button type="button" onclick="alert('THANK YOU for creating account with us')">Click Me</button>
            </div>
            
           <!-- <p>COMMENTS</p>
            <textarea rows="7" cols="100" maxlength="100" name="comment area" placeholder="entercomments..."></textarea><br>
           -->
           <a href="login.php">Already have an account, click here?</a>

        </form>
    </body>
</html>