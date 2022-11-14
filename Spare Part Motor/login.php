<?php
require 'db.php';
if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: admin.php");

        }
        else {
            echo
            "<script> alert('Wrong Password');</script>";
        }

    }
    else {
        echo
        "<script> alert('User Not Registered);</script>";
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
    <title>Login | Sparepartmotor</title>
    
</head>
<body>
    <div class="container">
        <div class="login">
            <form class="" action="" method="post" autocomplete="off">
            <h1>Login</h1>
                <hr>
                <p>Spare Part Motor</p>
                <label for="usernameemail">Username or Email</label>
                <input type="text" name="usernameemail" id = "usernameemail" require value="" placeholder="username or email">
                <label for="password">Password</label>
                <input type="password" name="password" id = "password" require value="" placeholder="password">
                <button type="submit" name="submit">Login</button>
                <p>
                    Belum ada akun?<a href="register.php">Register here</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="img/logo.sparepart.png">
        </div>
    </div>
</body>
</html>