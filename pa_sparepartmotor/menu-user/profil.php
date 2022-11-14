<?php

include '../db.php';
session_start();
//ceks session login
if(empty($_SESSION['login']) && empty($_SESSION['id'])){
    echo"
        <script>
        alert('Mohon untuk Login terlebih dahulu !!!');
        window.location.href=('../login.php');
        </script>
        " ;      
} 
$id = $_SESSION['id'];

$select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
$row_count = mysqli_num_rows($select_rows);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="product.css">
</head>
<body>
    <!-- Navbar Start -->
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
<!-- Navbar End -->
 

<div class="container">
   <h1 class="heading">latest products</h1>
   <?php
      $select_profil = mysqli_query($conn, "SELECT * FROM tb_user where name = $id");
      if(mysqli_num_rows($select_profil) > 0){
         while($cari_profil = mysqli_fetch_assoc($cari_profil)){
      ?>
      <div class="container">
    <h1 class="heading"> Profil</h1>
        <table>
            <tr>
                <th>Foto Profil</th>
                <td><img src="../img/<?php echo $cari_profil['foto']; ?>" ></td>
                <th>Nama</th>
                <th><?php echo $cari_profil['name'] ;?></th>
                <th>Username</th>
                <th><?php echo $cari_profil['username'] ;?></th>
                <th>Email</th>
                <th><?php echo $cari_profil['email'] ;?></th>
            </tr>
         <?php 
         };
        };
         ?>
        </table>
        </div>
   </div>


</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>