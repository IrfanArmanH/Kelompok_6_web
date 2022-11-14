<?php 
include "../db.php";
//jika session kosong maka user tidak bisa mengakses halaman menu user
    session_start();
        if(empty($_SESSION['login'])){
            echo"
                <script>
                alert('Mohon untuk Login terlebih dahulu !!!');
                window.location.href=('../login.php');
                </script>
                " ;      
        } 
          
$select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu customer</title>
    <link rel="stylesheet" href="menu_user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="menu_user.js"></script>

</head>
<body>
    
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Pencarian...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="user-cstmr">
                    <ul>
                        <li>
                            <a href="menu_user.php"><i class="fa-solid fa-house"></i></a>
                        </li>
                        <li>
                            <a href="market.php"><i class="fa-solid fa-store"></i></a>
                        </li>
                        
                        <li><i class="fa-solid fa-user-tie" ></i>
                            <ul class="drop-down-user">
                                <li><a href="profil.php">Profil</a></li><br><br>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="cart.php">
                                <i class="fa-solid fa-cart-shopping">
                                    <span><?php echo $row_count; ?></span>
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="pesan.php">
                            <i class="fa-solid fa-clipboard-list"></i>
                            </a>
                        </li>
                        <li><i class="fa-regular fa-bell"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- Image Slide Start -->
    <div class="container-image">
        <div class="content-image-slide">
            <div class="imgslide fade">
                <div class="numberslide">1 / 3</div>
                <img src="../img/content-gambar.jpg" alt="">
                <div class="text">Gambar 1</div>
            </div>

            <div class="imgslide fade">
                <div class="numberslide">2 / 3</div>
                <img src="../img/content-gambar2.jpg" alt="">
                <div class="text">Gambar 2</div>
            </div>

            <div class="imgslide fade">
                <div class="numberslide">3 / 3</div>
                <img src="../img/content-gambar3.jpg" alt="">
                <div class="text">Gambar 3</div>
            </div>

            <a class="prev" onClick="nextslide(-1)">&#10094;</a>
            <a class="next" onClick="nextslide(1)">&#10095;</a> 
        </div>
        
        <div class="page">
            <span class="dot" onClick="dotslide(1)"></span>
            <span class="dot" onClick="dotslide(2)"></span>
            <span class="dot" onClick="dotslide(3)"></span>
            <script src="image_slide.js"></script>
        </div>

    </div>
    <?php include "product.php";?>
    <div class="conatiner-card">
        
    </div>
    
        
</body>
</html>