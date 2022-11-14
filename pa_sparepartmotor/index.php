 <?php
   session_start();
   if(isset($_SESSION['akses'])){
       if($_SESSION['akses'] == "admin"){
       header("Location:../menu-admin/menu_admin.php");
       }
       else if($_SESSION['akses'] == "user"){
       header("Location:../menu-customer/menu_customer.php");
       }
    }
   
    if (isset($_POST['search'])){
        //variable
        $keyword = $_POST['input_search'];
        $query = $conn->query("SELECT * FROM tb_product WHERE nama LIKE '%$keyword%' ");
        $row = mysqli_num_rows($query);
        //cek apakah ada satu  
        if ($row==0){
            ?>
            <center><h3>404 NOT FOUND</h3></center>
            <?php  
        }
        else{
            ?>
            <center><h3>menampilkan <?php echo $row;?> data.</h3></center>
            <?php
            ?>
            <table class="table-sea">
            <tr class="nol">
                    <th class="main">NO</th>
                    <th class="main">Nama Barang</th>
                    <th class="main">Merek Barang</th>
            </tr>
            <?php
            foreach ($query as $rows){
            @$no++;
            $nama_barang = $rows['nama'];
            $merek_barang = $rows['merk'];;
            ?>
            <tr class="nol1">
            <td class="main2"><?php echo $no;?></td>
            <td class="main2"><?php echo $nama_barang;?></td>
            <td class="main2"><?php echo $merek_barang;?></td>
            </tr>
            <?php
            }
            ?>
            </table>
            <?php
        }
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
    <script src="jquery-3.6.0.min.js"></script>
    <title>Sparepart Motor</title>

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
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Merk</a></li>
                                <li><a href="#" class="show-prdouct">Product</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="login.php">Login</a></li>    
                            </ul>
                            <script>
                                document.querySelector(".show-product").addEventListener("click", function() {
                                    var x = document.getElementById("box");
                                        if (x.style.display === "block") {
                                            x.style.display = "none";
                                        } else {
                                            x.style.display = "block";
                                        }
                                });
                            </script>
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

        <!-- Hero -->
        <div class="hero">
            <div class="container">
                <div class="box-hero">
                    <h1>Upgrade Your Motorcycle Part <br>
                        For Comfortable Riding <br> 
                        Let's Ordered
                    </h1>
                    <div class="btn">
                        <form action="hasil-cari.php" method="POST">
                                <input type="text" placeholder="Cari Barang...." name="input_search">
                                <input type="submit" name="search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero -->

        <!-- Merk -->
        <div class="section-merk">
            <div class="container">
                <h1>Merk</h1>
                <div class="box">
                    <div class="col-5">
                        <img src="./img/Honda.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Yamaha.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Suzuki.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Kawasaki.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Ducati.png" width="120px" style="margin-bottom:5px;">
                    </div>
                </div>
            </div>
        </div>
        <!-- Merk -->

        <!-- Product -->
        <div class="section-product">
            <div class="container">
                <h1>Product</h1>
                <div class="box">
                    <div class="col-5">
                        <img src="./img/Honda.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Yamaha.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Suzuki.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Kawasaki.png" width="120px" style="margin-bottom:5px;">
                    </div>
                    <div class="col-5">
                        <img src="./img/Ducati.png" width="120px" style="margin-bottom:5px;">
                    </div>
            </div>
        </div>
        <!-- Product -->

        <!-- About -->
        <div class="section">
            <div>
                <div>
                    
                </div>
            </div>
        </div>
        <!-- About -->
    </header>
   <script src="js/script.js"></script>
</body>
</html>