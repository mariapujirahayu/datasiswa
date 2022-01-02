
		<div class="row">
	<center id="datasiswa">
			<h2>List Data Siswa</h2>
		</center>
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

				$ambil = $koneksi->query("SELECT * FROM siswa");
			?>
			<?php while ($pecah = $ambil->fetch_assoc()) {  ?>
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
	</div>