<?php

include '../db.php';
//cek session login 

session_start();

        if(empty($_SESSION['login']) && empty($_SESSION['name'])){
            echo"
                <script>
                alert('Mohon untuk Login terlebih dahulu !!!');
                window.location.href=('../login.php');
                </script>
                " ;      
        } 
        $user = $_SESSION['name'];
   
 
//insert table cart ke pesan
$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($value_cart = mysqli_fetch_assoc($select_cart)){
                $nama_barang = $value_cart['name'];
                $price = $value_cart['price'];
                $jumlah = $value_cart['quantity'];
                $foto = $value_cart['image'];
                $insert_product = mysqli_query($conn, "INSERT INTO pesan VALUES('','$user','$nama_barang', '$jumlah','$price','$foto','')");
            };
            
            
            // hapus data cart
            mysqli_query($conn, "DELETE FROM `cart`");
        };
$select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
$row_count = mysqli_num_rows($select_rows);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="product.css">

   <!-- import sweetalert js -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<section class="shopping-cart">

   <h1 class="heading">Pesanan Saya</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>status</th>
      </thead>

      <tbody>

         <?php 
         
         $cari_pesan = mysqli_query($conn, "SELECT * FROM pesan");
         $grand_total = 0;
         if(mysqli_num_rows($cari_pesan) > 0){
            while($pesan = mysqli_fetch_assoc($cari_pesan)){
         ?>

         <tr>
            <td><img src="../product/<?php echo $pesan['foto']; ?>" height="100" alt=""></td>
            <td><?php echo $pesan['name']; ?></td>
            <td>Rp<?php echo $pesan['price']; ?></td>
            <td><?php echo $pesan['quantity']; ?></td>
            <td>Rp<?php echo $sub_total = $pesan['price'] * $pesan['quantity']; ?></td>
            <td>
               <?php 
               if ($pesan['status'] == 0){
                  echo '<button class="btn-timer">'.'<i class="fa-solid fa-stopwatch">'.'</i>'.'tunggu konfirmasi'.'</button>';
                  
               }else if(($pesan['status'] != 0)){
                  echo'<button class="btn-check">'.'<i class="fa-solid fa-check">'.'</i>'.'Pesanan telah di konfirmasi'.'</button>';
               }
            };
         };
            
               ?>
                 
            </td>
            
            
         </tr>
         <tr class="table-bottom">
            <td colspan="4">Deskripsi Pesan</td>
            <td colspan="2">
               <?php
               $cari_pesan = mysqli_query($conn, "SELECT * FROM pesan");
               $pesan = mysqli_fetch_array($cari_pesan);
               if ($pesan['status'] == 0){
                  echo"Silahkan Tunggu Konfirmasi dari Admin";
                  
               }else if(($pesan['status'] != 0)){
                  echo'Pesanan anda telah dikonfirmasi silahkan ambil barang anda!!';
               }
               
            
               ?>
            </td>
         </tr>

      </tbody>

   </table>
<!-- 
   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" >Klik untuk Order</a>
      <button class="btn-order <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="myFunction()">Klik untuk Order</button>
      
      
      
      </div> -->
      <!-- <button class="trigger">Click here to trigger the modal!</button>
      <div class="modal">
         <div class="modal-content">
            <span class="close-button">&times;</span>
            <h1>Barang kamu telah berhasil di order</h1><br>
            <h1>Silahkan tunggu konfirmasi dari Admin</h1><br>
            <button>OK</button>
         </div>
      
   <script>
      
      const modal = document.querySelector(".modal");
      const trigger = document.querySelector(".trigger");
      const closeButton = document.querySelector(".close-button");

      function toggleModal() {
         modal.classList.toggle("show-modal");
      }

      function windowOnClick(event) {
         if (event.target === modal) {
            toggleModal();
         }
      }
      trigger.addEventListener("click", toggleModal);
      closeButton.addEventListener("click", toggleModal);
      window.addEventListener("click", windowOnClick);
   </script> -->
   </div>

</section>

</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>