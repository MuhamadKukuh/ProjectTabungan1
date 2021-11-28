<?php  
	session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';

		$siswa = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_role = 1 ORDER BY nama ASC ");
	

	$no = 1;

 ?>
<body class="bg-dark">
	<?php include '../navbar/nav.php'; ?>
	<div class="container pt-3 pb-2 mt-3 rounded border border-2 border-light" style="background: linear-gradient(to right,#043927,#078d5f, #043927);">
		<?php if(isset($_SESSION["success"])): ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
	          <strong>Penambahan Guru Berhasil</strong>
	          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	        </div>
		<?php endif ?>
		<?php if (isset($_SESSION["success"])): ?>
			<?php unset($_SESSION['success']) ?>
		<?php endif ?>
		<div class="d-flex justify-content-center">
			<input type="" id="cari" onkeyup="cariSiswa()" name="" class="form-control mt-3" style="max-width: 430px" placeholder="Cari Guru ..">
		</div>
		<div class="row container mt-3">
			<a href="dashboard.php" class="text-decoration-none text-white">Dashboard</a>
			<a href="tambahguru.php" class="text-end text-decoration-none text-white">Tambah Guru</a>

			<table class="table text-light">
			  <thead>
			    <tr>
			      <th scope="col">No</th>
			      <th scope="col">Nama</th>
			      <th scope="col">Gender</th>
			      <th scope="col">Kelas</th>
			      <th scope="col">Nis</th>
			      <th scope="col">No Tlp</th>
			      <th scope="col">Hapus</th>
			    </tr>
			  </thead>
			  <tbody id="daftarSiswa">
			  	<?php foreach ($siswa as $key): ?>
			  		<tr>
				      <th scope="row"><?php echo $no++ ?></th>
				      <td><?php echo $key["nama"]; ?></td>
				      <td><?php echo $key["gender"]; ?></td>
				      <td><?php echo $key["kelas"]; ?></td>
				      <td><?php $nis = sprintf("%s.%s.%s",
                                substr($key["nis"], 0, 4),
                                substr($key["nis"], 4, 2),
                                substr($key["nis"], 6)); 
                                echo $nis ?></td>
				      <td>0<?php $not = $key["no_tlp"];
				      // $tlp = number_format($not, 0, ",", "-");
				      $result = sprintf("%s-%s-%s",
				                substr($key["no_tlp"], 1, 3),
				                substr($key["no_tlp"], 4, 4),
				                substr($key["no_tlp"], 8)); 
				                echo $result ?></td>
				      <td>
				      	<form action="../../route/web.php" method="post">
				      		<button type="submit" value="<?php echo $key["id_user"]; ?>" name="hapusguru" class="btn bg-dark border border-2 border-danger text-danger" onclick="hapusMurid()">Hapus</button>
				      	</form>
				      </td>
				    </tr>
			  	<?php endforeach ?>
			  </tbody>
			</table>
		</div>
	</div>
	<script src="../../public/js/search.js"></script>

</body>