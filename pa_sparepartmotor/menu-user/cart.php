<?php

include '../db.php';
//ceks session login
session_start();
        if(empty($_SESSION['login'])){
            echo"
                <script>
                alert('Mohon untuk Login terlebih dahulu !!!');
                window.location.href=('../login.php');
                </script>
                " ;      
        } 

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
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

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="../product/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['price']; ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>Rp<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?></td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">Jumlah Harga</td>
            <td>Rp<?php echo $grand_total; ?></td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" >Klik untuk Order</a>
      <button class="btn-order <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="myFunction()" >Klik untuk Order</button>
      
      
      
      </div>
      <button class="trigger">Click here to trigger the modal!</button>
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
   </script>
   </div>

</section>

</div>
   <script>
         document.querySelector(".btn-order").addEventListener("click", function Myfunction() {
            //tampilkan sweet alert selama 2 detik setelah masuk ke pesan
         Swal.fire({
         icon: 'success',
         width: '40%',
         timer:2000,
         height: '25%',
         title: 'Barang Berhasil di Pesan',
         text: 'Tunggu Konfirmasi dari Admin'
         }).then(function() {
            window.location.href = "pesan.php";
        });
      });
      
      </script>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>