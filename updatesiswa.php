<?php include 'koneksi.php'; 
    $ambil = $koneksi->query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
    $pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Siswa</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-sm fixed-top">
		<a class="navbar-brand" href="index.php">Data Siswa</a>
	</nav>
	<!-- Navbar End -->
	<div class="container" >
        <?php include 'efek.php'; ?>
		<center id="datasiswa">
			<h2>Update Data Siswa</h2>
		</center>
        <div class="card-body">
            <div class="penjelasan" style="margin-top:20px; margin-bottom:30px;">
                <h6>Data alternatif sebelum diubah</h6>
                <form>
                    <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                        <label>Nama</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo $pecah['nama']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo $pecah['tgl_lahir']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                        <label>Gender</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo $pecah['gender']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                        <label>Kelas</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo ($pecah['kelas']); ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>

		<form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="col-form-label">Nama Siswa:</label>
                <input type="text" class="form-control" name="nama" required value="<?php echo $pecah['nama']; ?>">
            </div>
            <div class="mb-3">
                <label for="ttl" class="col-form-label">Tanggal Lahir:</label>
                <input type="date" class="form-control" name="ttl" required value="<?php echo $pecah['tgl_lahir']; ?>">
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Gender:</label>
                <select class="form-control" name="gender" required value="<?php echo $pecah['nama']; ?>">
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-laki">Laki-laki</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Kelas:</label>
                <!-- <textarea class="form-control" id="message-text"></textarea> -->
                <select class="form-control" name="kelas" required value="<?php echo $pecah['kelas']; ?>">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="ubah">Simpan</button>
        </form>
        <!-- database -->
        <?php
            if (isset($_POST['ubah'])) {
                $koneksi->query("UPDATE siswa SET nama='$_POST[nama]', tgl_lahir='$_POST[ttl]', gender='$_POST[gender]', kelas='$_POST[kelas]' WHERE id_siswa='$_GET[id]'");
                echo "<script>alert('Data Siswa telah berhasil Diubah!');</script>";
                echo "<script>location='index.php#datasiswa';</script>";
            }
        ?>
	</div>
</body>
</html>