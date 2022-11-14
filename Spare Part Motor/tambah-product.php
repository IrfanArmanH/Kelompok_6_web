<?php
    session_start();
    include 'db.php';
    // if($_SESSION['status_login'] != true){
    //     echo '<script>window.location="profil.php"</script>'; 
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
            <h3>Tambah Data Product</h3>
            <div class="box">
                <form class="form-profil" action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="merk" id="" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $merk = mysqli_query($conn, "SELECT * FROM tb_merk ORDER BY merk_id DESC");
                            while($r = mysqli_fetch_array($merk)){
                        ?>
                        <option value="<?php echo $r['merk_id'] ?>"><?php echo $r['merk_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Product" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="text" name="stok" class="input-control" placeholder="Stok" required>
                    <input type="file" name="gambar" class="input-control" placeholder="" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="submit">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        // print_r($_FILES['gambar']);
                        // menampung inputan dari form
                        $merk      = $_POST['merk'];
                        $nama      = $_POST['nama'];
                        $harga     = $_POST['harga'];
                        $stok      = $_POST['stok'];
                        $deskripsi = $_POST['deskripsi'];
                        $status    = $_POST['status'];

                        // menampung dara file yang diupload 
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'product'.time().'.'.$type2;
    
                        // menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gift');

                        // validasi format file
                        if(!in_array($type2, $tipe_diizinkan)){
                            // jika format fie tidak ada didalam tipe diizinikan
                            echo '<script>alert("Format file diizinkan")</script>';
                        }else{
                            // jika format file sesuai dengan yang ada dialam array diizinkan
                            // proses upload file sekaligus insert ke database
                            move_uploaded_file($tmp_name, './product/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                        null,
                                        '".$merk."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$stok."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                            ) ");
                            
                            if($insert){
                                echo '<script>alert("Tambah data berhasil")</scirpt>';
                                echo '<script>window.location="data-product.php"</scirpt>';
                            }else{
                                echo 'gagal'.mysqli_error($conn);
                            }

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