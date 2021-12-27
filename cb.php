<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- import bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <br>
    <!-- membuat container dengan lebar colomn col-lg-10  -->
    <div class="container col-lg-10">
        <!-- membuat tulisan alert berwarna hijau dengan tulisan di tengah  -->
        <h3 class="alert alert-success text-center" role="alert">
            Tutorial Modal Edit Data Dinamis
        </h3>
        <br>
        <!-- membuat card untuk membungkus tabel bootstrap  -->
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <!-- set table header  -->
                        <tr>
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal Lahir</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM siswa ORDER BY id_siswa ASC"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <!-- menampilkan data dengan menggunakan array  -->
                            <td class="text-center"><?php echo $nomor++; ?></td>
                            <td class="text-center"><?php echo $pecah['nama']; ?></td>
                            <td class="text-center"><?php echo $pecah['tgl_lahir']; ?></td>
                            <td class="text-center"><?php echo $pecah['gender']; ?></td>
                            <td class="text-center"><?php echo $pecah['kelas']; ?></td>
                            <td>
                            <!-- tombol edit dan modal akan dibuat disini -->
                            <!-- membuat tombol dengan ukuran small berwarna biru  -->
                            <!-- data-target setiap modal harus berbeda, karena akan menampilkan data yang berbeda pula
                            caranya membedakannya, gunakan id_barang sebagai pembeda data-target di setiap modal -->
                            <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#modal<?php echo $pecah['id_siswa']; ?>">Edit</a>
                            </td>
                        </tr>
                        <!-- Modal Update Data -->
                        <div class="modal fade" id="modal<?php echo $pecah['id_siswa']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                                        data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                                        <div class="modal-body">
                                            <form method="post" action="editmhs.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Nama</label>
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" name="ttl" value="<?php echo $pecah['tgl_lahir']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Gender</label>
                                                    <!-- <input type="text" class="form-control" name="gender" value="<?php echo $pecah['gender']; ?>"> -->
                                                    <select class="form-control" name="gender" id="selectgender" required value="<?php echo $pecah['gender']; ?>">
                                                        <option value="Perempuan">Perempuan</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Kelas</label>
                                                    <input type="text" class="form-control" name="kelas" value="<?php echo $pecah['kelas']; ?>">
                                                </div>
                                                <button type="button" class="btn btn-primary" name="ubah">Save changes</button>
                                            </form>
                                        </div>
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" name="ubah">Save changes</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Update Data End -->
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- !-- database add siswa --> 
            <?php
                //query update
                if (isset($_POST['ubah'])) {
                    $koneksi->query("UPDATE siswa SET nama='$_POST[nama]', tgl_lahir='$_POST[ttl]', gender='$_POST[gender]', kelas='$_POST[kelas]' WHERE id_siswa='id' ");
                    
                    // $koneksi->query("UPDATE data_alternatif SET alamat='$_POST[alamat]', kriteria1='$_POST[kmrtdr]', kriteria2='$_POST[parkir]', kriteria3='$_POST[fasilitas]', kriteria4='$_POST[kmrmnd]', kriteria5='$_POST[furniture]', kriteria6='$_POST[harga]', c2='$c2', c3='$c3', c5='$c5', c6='$c6', b1='$b1', b2='$b2', b3='$b3', b4='$b4', b5='$b5', b6='$b6' WHERE id_alternatif='$_GET[id]'");
                    echo "<script>alert('Data Alternatif telah berhasil Diubah!');</script>";
                    echo "<script>location='alternatif.php';</script>";
                }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>
</html>