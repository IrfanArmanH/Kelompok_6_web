<?php
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_row($duplicate) > 0){
        echo
        "<script> alert('Username or Email Has Already Taken')</script>";
    }
    else {
        if($password == $confirmpassword){
            $query = "INSERT INTO tb_user VALUES('','$name','$username','$email','$password')";
            mysqli_query($conn,$query);
            echo
            "<script> alert('Registration Successfull')</script>";
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
            <form action="">
                <h1>Register</h1>
                <hr>
                <p>Spare Part Motor</p>
                <label for="name">Name</label>
                <input type="text" name="name" id ="name" require value="" placeholder="name">
                <label for="username">Username</label>
                <input type="text" name="username" id ="username" require value="" placeholder="username">
                <label for="email">Email</label>
                <input type="email" name="email" id ="email" require value="" placeholder="password">
                <label for="">Password</label>
                <input type="password" placeholder="password">
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