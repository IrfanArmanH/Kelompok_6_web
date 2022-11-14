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
        if(isset($_POST['update_btn'])){
            $update_id = $_POST['update_quantity_id'];
            $update_quantity_query = mysqli_query($conn, "UPDATE pesan SET status = 1 WHERE id = '$update_id'");
            if($update_quantity_query){
               header('location:data-pesan.php');
            };
         };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Link Font style -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Data Pesan</title>

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
            <h3>Data Pesan</h3>
            <div class="box">
                <table cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama Pemesan</th>
                            <th>Nama Barang</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data_pesan = mysqli_query($conn, "SELECT * FROM pesan");

                        if(mysqli_num_rows($data_pesan) > 0){
                        while($cari_pesan = mysqli_fetch_array($data_pesan)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $cari_pesan['pemesan'] ?></td>
                            <td><?php echo $cari_pesan['name'] ?></td>
                            <td><?php echo $cari_pesan['quantity'] ?></td>
                            <td><?php echo $cari_pesan['price'] ?></td>
                            <td><a href="product/<?php echo $cari_pesan['foto'] ?>" target="_blank"><img src="product/<?php echo $cari_pesan['foto'] ?>" width="50px"></a></td>
                            <td>
                            <?php 
                            
                            if ($cari_pesan['status'] == 0){
                                echo '<button class="btn-timer">'.'<i class="fa-solid fa-stopwatch">'.'</i>'.'Pesanan Belum Dikonfirmasi'.'</button>';
                                
                            }else if(($cari_pesan['status'] != 0)){
                                echo'<button class="btn-timer">'.'<i class="fa-solid fa-check">'.'</i>'.'Pesanan telah di konfirmasi'.'</button>';
                            }
                            
                            ?>
                            </td>
                            <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id"  value="<?php echo $cari_pesan['id']; ?>" >
                                <input type="submit" value="konfirmasi" name="update_btn" class="submit">
                            </form>   
                            </td>
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