<?php
include "db.php";
if(isset($_POST["submit"])){
    //ambil inputan data form
    $name = htmlspecialchars($_POST["name"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    //enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $confirmpassword = password_hash($_POST["confirmpassword"],PASSWORD_DEFAULT);


    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> 
            alert('Username or Email Has Already Taken');
        </script>";
    }
    else {
        if($password == $confirmpassword){
            $insert_product = mysqli_query($conn, "INSERT INTO tb_user (name, username,password, email) VALUES('$name', '$username', '$password','$email')");
            echo
            "<script> alert('Registration Successfull')</script>";
            header("Location:login.php");
        }
        else {
            echo
            "<script> alert('Password Does Not Match')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Registration | Spare Pare Motor</title>
</head>
<body>
    <div class="container">
        <div class="login">
            <form action="" method="POST">
                <h1>Register</h1>
                <hr>
                <p>Spare Part Motor</p>
                <label for="name">Name</label>
                <input type="text" name="name" id ="name" require value="" placeholder="name">
                <label for="username">Username</label>
                <input type="text" name="username" id ="username" require value="" placeholder="username">
                <label for="email">Email</label>
                <input type="email" name="email" id ="email" require value="" placeholder="email">
                <label for="password">Password</label>
                <input type="password" placeholder="password" name="password" require value="">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" name="confirmpassword" id="confirmpassword" require value="" placeholder="password">
                <button type="submit" name="submit">Register</button>
                <p>
                   <a href="login.php">Login</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="img/logo.sparepart.png">
        </div>
    </div>
</body>
</html>