<?php  
	session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';
	$id = $_SESSION["auth"];

	$parameter = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user='$id' ");
	$row       = mysqli_fetch_assoc($parameter);

	$kelas = $row["id_kelas"];

	if ($row["id_role"] == 1) {
		$siswa = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_role = 2 AND register.id_kelas ='$kelas' ORDER BY nama ASC ");
	}else{
		$siswa = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_role = 2 ORDER BY nama ASC ");
	}
	

	$no = 1;

 ?>
<body class="bg-dark">
	<?php include '../navbar/nav.php'; ?>
	<div class="container pt-3 pb-2 mt-3 rounded border border-2 border-light" style="background: linear-gradient(to right,#043927,#078d5f, #043927);">
		<div class="d-flex justify-content-center">
			<input type="" id="cari" onkeyup="cariSiswa()" name="" class="form-control mt-3" style="max-width: 430px" placeholder="Cari siswa ..">
		</div>
		<div class="row container mt-3">
			<a href="dashboard.php" class="text-decoration-none text-white">Dashboard</a>
			<?php if ($row["id_role"] == 3): ?>
				<a href="tambahkelas.php" class="text-end text-decoration-none text-white">Tambah Kelas</a>
			<?php endif ?>
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
				      <td>
				      	<form action="../../route/web.php" method="post">
				      		<button type="submit" name="lihatRiwayat" value="<?php echo $key["id_user"] ?>" class="btn btn-outline-light"><?php echo $key["nama"]; ?></button>
				      	</form>
				      </td>
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
				      		<button type="submit" value="<?php echo $key["id_user"]; ?>" name="hapussiswa" class="btn bg-dark border border-2 border-danger text-danger" onclick="hapusMurid()">Hapus</button>
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