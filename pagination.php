<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Pagination -  Malasngoding.com</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h2>Membuat Pagination PHP, MySQLI dan Boostrap 4</h2>
		</center>
		<br>
		<br>
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
					<button class="btn btn-primary" type="button">Add Data Siswa</button>
					<!-- <button class="btn btn-primary" type="button">Button</button> -->
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
					<button class="btn btn-outline-success" type="button">Update</button>
					<button class="btn btn-outline-danger" type="button">Delete</button>
				</span>
			</td>
        </tr>
        <?php } ?>
			</tbody>
		</table>
        <nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>	
	</div>
</body>
</html>