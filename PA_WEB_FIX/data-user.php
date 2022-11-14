<?php
    include 'db.php';
    session_start();
        if(empty($_SESSION['login'])){
            echo"
                <script>
                alert('Mohon untuk Login terlebih dahulu !!!');
                window.location.href=('../login.php');
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
    <title>Data User</title>

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
            <h3>Data User</h3>
            <div class="box">
                <table cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>foto</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE name != 'admin'");
                        if(mysqli_num_rows($data_user) > 0){
                        while($row = mysqli_fetch_array($data_user)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><a href="upload_image/<?php echo $row['foto'] ?>" target="_blank"><img src="upload_imagr/<?php echo $row['foto'] ?>" width="50px"></a></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="5">Tidak ada data</td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   <script src="js/script.js"></script>
</body>
</html>