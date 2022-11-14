<?php
    session_start();
    include 'db.php';
    // if($_SESSION['status_login'] != true){
    //     echo '<script>window.location="login.php"</script>';
    // }
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
                                <li><a href="data-pesan.php">Data Cart</a></li>
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
            <h3>Data Merk</h3>
            <div class="box">
                <p><a href="tambah-merk.php">Tambah Data</a></p>
                <br>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Merk</th>
                            <th>Gambar</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $merk = mysqli_query($conn, "SELECT * FROM tb_merk ORDER BY merk_id DESC");
                        if(mysqli_num_rows($merk) > 0){
                            while($row = mysqli_fetch_array($merk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['merk_name'] ?></td>
                            <td><a href="merk/<?php echo $row['merk_image'] ?>" target="_blank"><img src="merk/<?php echo $row['merk_image'] ?>" width="50px"></a></td>
                            <td>
                                <a href="edit-merk.php?id=<?php echo $row['merk_id'] ?>">Edit</a> || <a href="proses-hapus.php?idm=<?php echo $row['merk_id']?>">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="4">Tidak ada data</td>
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