<?php
    include('koneksi.php');
    $sql = "DELETE FROM siswa WHERE id_siswa='$_GET[id]'";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data Siswa Berhasil Dihapus');window.location='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
?>