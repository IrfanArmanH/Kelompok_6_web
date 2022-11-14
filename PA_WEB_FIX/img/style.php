<?php 
header("Content-type: text/css; charset: UTF-8"); 

$color_background = 'rgb(35, 221, 221)';
$width1 ='600px';
$height1 ='500px';
$margin_tabel='8px';

?>

body{
    background-color:<? = $color_background ?>;
    width:<? = $width1 ?>;
}

tabel{
    margin:<?= $margin_tabel ?>;
}

.tampil-data{
    width :650px;
    height:400px;
    color:red;
}