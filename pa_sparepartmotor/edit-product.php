<?php
    session_start();
    include 'db.php';
    // if($_SESSION['status_login'] != true){
    //     echo '<script>window.location="profil.php"</script>'; 
    // }
    $product = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($product);
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
                                <li><a href="data-cart.php">Data Pesan</a></li>
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
            <h3>Edit Data Product</h3>
            <div class="box">
                <form class="form-profil" action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="merk" id="" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $merk = mysqli_query($conn, "SELECT * FROM tb_merk ORDER BY merk_id DESC");
                            while($r = mysqli_fetch_array($merk)){
                        ?>
                        <option value="<?php echo $r['merk_id'] ?>" <?php echo ($r['merk_id'] == $p->merk_id)? 'selected':''; ?>><?php echo $r['merk_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Product" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    <input type="text" name="stok" class="input-control" placeholder="Stok" value="<?php echo $p->product_stok ?>" required>
                    
                    <img src="product/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control" placeholder="">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="submit">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        
                        // data inputan ari form
                        $merk      = $_POST['merk'];
                        $nama      = $_POST['nama'];
                        $harga     = $_POST['harga'];
                        $stok      = $_POST['stok'];
                        $deskripsi = $_POST['deskripsi'];
                        $status    = $_POST['status'];
                        $foto      = $_POST['foto'];

                        // data gambar yang baru
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        // jika admin ganti gambar
                        if($filename != ''){
                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];
    
                            $newname = 'product'.time().'.'.$type2;
    
                             // menampung data format file yang diizinkan
                             $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gift');

                            if(!in_array($type2, $tipe_diizinkan)){
                                // jika format fie tidak ada didalam tipe diizinikan
                                echo '<script>alert("Format file diizinkan")</script>';
                            }else{
                                unlink('./product/'.$foto);
                                move_uploaded_file($tmp_name, './product/'.$newname);
                                $namagambar = $newname;
                            }

                        }else{
                            // jika admin tidak ganti gambar
                            $namagambar = $foto;
                        }
                          
                        // query update data 
                        $update = mysqli_query($conn, "UPDATE tb_product SET
                                                merk_id = '".$merk."',
                                                product_name = '".$nama."',
                                                product_price = '".$harga."',
                                                product_stok = '".$stok."',
                                                product_description = '".$deskripsi."',
                                                product_image = '".$namagambar."',
                                                product_status = '".$status."'
                                                WHERE product_id = '".$p->product_id."' ");

                         if($update){
                            echo '<script>alert("Ubah data berhasil")</scirpt>';
                            echo '<script>window.location="data-product.php"</scirpt>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
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