<?php
include('koneksi.php');
//query update
// $query = "UPDATE mhs SET nama='$nama' , fakultas='$fakultas' WHERE id='$id' ";
$query = ("INSERT INTO siswa(nama,tgl_lahir,gender,kelas) VALUES('$_POST[nama]','$_POST[ttl]','$_POST[gender]','$_POST[kelas]')");
// $koneksi->query("INSERT INTO siswa(nama,tgl_lahir,gender,kelas) VALUES('$_POST[nama]','$_POST[ttl]','$_POST[gender]','$_POST[kelas]')");
if (mysqli_query($koneksi, $query)) {
    # credirect ke page index
    header("location:index.php");    
}
else{
    echo "ERROR, data gagal diupdate". mysqli_error();
}
?>