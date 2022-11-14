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

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

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
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<div class="container">

<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `tb_product`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

    <form action="" method="post">
         <div class="box">
            <img src="../product/<?php echo $fetch_product['product_image']; ?>" alt="">
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">Rp.<?php echo $fetch_product['product_price']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['product_price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['product_image']; ?>">
            <input type="submit" class="btn" value="tambah keranjang" name="add_to_cart">
            <input type="submit" class="btn" value="Detail" name="detail">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>