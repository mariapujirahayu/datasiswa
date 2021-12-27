<?php include 'koneksi.php'; ?>
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
		<div class="row">
			<div class="col-sm-6">
				<h2>Data Siswa</h2>
				<a class="btn btn-info" href="#datasiswa">Lihat Data Siswa</a> 
				<!-- <a class="btn btn-info" href="#">Hapus</a>  -->
			</div>
			<div class="col-sm-6">
				<img src="img/1.png" class="rounded" alt="Cinque Terre"> 
			</div>
		</div>
		<center id="datasiswa">
			<h2>List Data Siswa</h2>
		</center>
		<form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
			<div class="col-auto">
				<?php
					$kata_kunci="";
					if (isset($_POST['kata_kunci'])) {
						$kata_kunci=$_POST['kata_kunci'];
					}
				?>
				<input type="text" name="kata_kunci" value="<?php echo $kata_kunci;?>" class="form-control" id="inputPassword2" placeholder="Search...">
			</div>
			<div class="button">
				<button type="submit" class="btn btn-primary mb-3">Search</button>
				<span>
					<!-- <button class="btn btn-primary" type="button">Add Data Siswa</button> -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Data Siswa</button>
				</span>
			</div>
		</form>
		<table class="table table-striped table-hover">
			<thead class="table-primary">
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
			<?php 
				$batas = 5;
				$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

				$previous = $halaman - 1;
				$next = $halaman + 1;

				$ambil = $koneksi->query("SELECT * FROM siswa");
				// if (isset($_POST['kata_kunci'])) {
				// 	$kata_kunci=trim($_POST['kata_kunci']);
				// 	$ambil = $koneksi->query("SELECT * FROM siswa WHERE nama LIKE '%".$kata_kunci."%' OR tgl_lahir LIKE '%".$kata_kunci."%' OR gender LIKE '%".$kata_kunci."%' OR kelas LIKE '%".$kata_kunci."%' ORDER BY id_siswa ASC"); 
				// }else {
				// 	$ambil = $koneksi->query("SELECT * FROM siswa ORDER BY id_siswa ASC"); 
				// } 
						
				$jumlah_data = mysqli_num_rows($ambil);
				$total_halaman = ceil($jumlah_data / $batas);

				// $data_pegawai = $koneksi->query("select * from siswa limit $halaman_awal, $batas");
				if (isset($_POST['kata_kunci'])) {
					$kata_kunci=trim($_POST['kata_kunci']);
					$data_pegawai = $koneksi->query("SELECT * FROM siswa WHERE nama LIKE '%".$kata_kunci."%' OR tgl_lahir LIKE '%".$kata_kunci."%' OR gender LIKE '%".$kata_kunci."%' OR kelas LIKE '%".$kata_kunci."%' ORDER BY id_siswa ASC LIMIT $halaman_awal, $batas"); 
				}else {
					$data_pegawai = $koneksi->query("SELECT * FROM siswa ORDER BY id_siswa ASC LIMIT $halaman_awal, $batas"); 
				} 
				$nomor = $halaman_awal+1;
			?>
			<?php while ($pecah = $data_pegawai->fetch_assoc()) {  ?>
			<tr>
				<td class="text-center"><?php echo $nomor++; ?></td>
				<td class="text-center"><?php echo $pecah['nama']; ?></td>
				<td class="text-center"><?php echo $pecah['tgl_lahir']; ?></td>
				<td class="text-center"><?php echo $pecah['gender']; ?></td>
				<td class="text-center"><?php echo $pecah['kelas']; ?></td>
				<td class="text-center">
					<span>
						<!-- <button class="btn btn-outline-success"  type="button">Update</button> -->
						<a class="btn btn-outline-success" href="updatesiswa.php?id=<?php echo $pecah["id_siswa"] ?> ">Update</a> 
						<a class="btn btn-outline-danger" href="hapussiswa.php?id=<?php echo $pecah["id_siswa"] ?> ">Hapus</a> 
					</span>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
		<!-- Pagination -->
        <div>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>&laquo;</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){ ?> 
				<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
				<?php } ?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>&raquo;</a>
				</li>
			</ul>
		</div>
		<!-- Pagination End -->
		<!-- Modal Tambah Data -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
				<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Tambah Data Siswa</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form method="post" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="nama" class="col-form-label">Nama Siswa:</label>
								<input type="text" class="form-control" name="nama" id="selectnama" required>
							</div>
							<div class="mb-3">
								<label for="ttl" class="col-form-label">Tanggal Lahir:</label>
								<input type="date" class="form-control" name="ttl" id="selectttl" required>
							</div>
							<div class="mb-3">
								<label for="recipient-name" class="col-form-label">Gender:</label>
								<!-- <input type="text" class="form-control" id="recipient-name"> -->
								<select class="form-control" name="gender" id="selectgender" required>
									<option value="Perempuan">Perempuan</option>
									<option value="Laki-laki">Laki-laki</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="message-text" class="col-form-label">Kelas:</label>
								<!-- <textarea class="form-control" id="message-text"></textarea> -->
								<select class="form-control" name="kelas" id="selectkelas" required>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
							</div>
							<button class="btn btn-primary" name="save">Simpan</button>
						</form>
					</div>
					<!-- Modal footer -->
					<!-- <div class="modal-footer"> -->
						<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
						<!-- <button type="button" class="btn btn-primary" name="simpan">Simpan</button> -->
					<!-- </div> -->
				</div>
			</div>
			<!-- !-- database add siswa --> 
			<?php
				if (isset($_POST['save'])) {
					$koneksi->query("INSERT INTO siswa(nama,tgl_lahir,gender,kelas) VALUES('$_POST[nama]','$_POST[ttl]','$_POST[gender]','$_POST[kelas]')");
					echo "<div class='alert alert-info'>Data Tersimpan</div>";
					echo "<meta http-equiv='refresh' content='1;url=index.php#datasiswa'>";
				}
			?>
		</div>
		<!-- Modal Tambah Data End -->
	</div>
</body>
</html>