<?php
    session_start();
    include 'db.php';
    // if($_SESSION['status_login'] != true){
    //     echo '<script>window.location="profil.php"</script>'; 
    // }

    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Dashboard Admin</title>

</head>
<body>
    <header>
        <!-- Navbar -->
        <div class="section">
            <div class="navbar">    
                <div class="navigation">
                    <div class="container">
                        <div class="box-navbar">
                            <img src="./img/logo.sparepart.png" alt="">
                            <h1>Spare Part Motor</h1>
                            <div class=""logo></div>
                            <ul class="menu">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="data-merk.php">Data Merk</a></li>
                                <li><a href="data-product.php">Data Product</a></li>
                                <li><a href="data-user.php">Data User</a></li>
                                <li><a href="data-cart.php">Data Cart</a></li>
                                <li><a href="profil.php">Profil</a></li>
                                <li><a href="logout.php">Log Out</a></li>    
                            </ul>
                            <div class="btn-switch">
                                <i class="ri-moon-fill dark-mode"></i>
                                <i class="ri-moon-line light-mode"></i>
                            </div>
                            <i class="ri-menu-line fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar -->
    </header>

    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form class="form-profil" action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->email ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="submit">
                    
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $nama      = ucwords($_POST['nama']);
                        $user      = $_POST['user'];
                        $email     = $_POST['email'];

                        $update    = mysqli_query($conn, "UPDATE tb_user SET
                                            name = '".$nama."',
                                            username = '".$user."',
                                            email = '".$email."',
                                            WHERE user_id = '".$d->user_id."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'gaga '.mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - Sparepartmotor</small>
        </div>
    </footer>
   <script src="js/script.js"></script>
</body>
</html>