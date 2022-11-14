
<?php
//koneksi
include "db.php";
if (isset($_POST['search'])){
    $keyword = $_POST['input_search'];
    $query = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_name LIKE '%$keyword%' ");
    $cari = mysqli_num_rows($query);
    $no = 0;
    
    //cek apakah ada satu  
    if ($cari==0){
        ?>
        <center><h3>404 NOT FOUND</h3></center>
        <?php  
    }
    else{
        ?>
        <center><h3>menampilkan <?php echo $cari;?> data.</h3></center>
        <?php
        ?>
       <link rel="stylesheet" href="index.css">
        <table class="table-sea">
        <tr class="nol">
                <td class="main">NO</td>
                <td class="main">Nama Barang</td>
                <th class="main">Harga Barang</td>
                <td> Foto barang</td>
        </tr>
        <?php
        while($rows = mysqli_fetch_assoc($query)){

            $no++;
            $nama_barang = $rows['product_name'];
            $harga_barang = $rows['product_price'];
            $foto_barang = $rows['product_image'];
            ?>
            <tr class="nol1">
            <td class="main2"><?php echo $no;?></td>
            <td class="main2"><?php echo $nama_barang;?></td>
            <td class="main2"><?php echo $harga_barang;?></td>
            <td class="main2"><img src="product/<?php echo $foto_barang;?>" style="width:100px;"></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }
}