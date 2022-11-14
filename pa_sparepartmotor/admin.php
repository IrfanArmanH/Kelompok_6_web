<?php
//jika session kosong maka user tidak bisa mengakses halaman menu admin
        session_start();
        if(empty($_SESSION['login'])){
            echo"
                <script>
                alert('Mohon untuk Login terlebih dahulu !!!');
                window.location.href=('login.php');
                </script>
                " ;      
        }
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
                                <li><a href="admin.php">Dashboard</a></li>
                                <li><a href="data-merk.php">Data Merk</a></li>
                                <li><a href="data-product.php">Data Product</a></li>
                                <li><a href="data-user.php">Data User</a></li>
                                <li><a href="data-pesan.php">Data Pesan</a></li>
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
            <h3>Dashboard</h3>
            <div class="box">
                <h4>Selamat Datang</h4>
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