<?php
 header('Content-Type: application/json; charset=utf8');
  
  //koneksi kedatabase penjualan
 $server = "localhost";
  $user = "root";
 $pass = "";
 $dbname = "penjualan";

 $koneksi = mysqli_connect($server,$user,$pass,$dbname);
 //query tabel produk
 $sql="SELECT * FROM produk";
 $query=mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

 $array=array();
 while($data=mysqli_fetch_assoc($query)) $array[]=$data; 

 //mengubah data array menjadi format json
 echo json_encode($array);
?>