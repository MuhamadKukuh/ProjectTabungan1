<?php 
    session_start();
	include '../../db.php';
	include '../../auth/superAdminSession.php';
	$siswa = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON kelas.id_kelas = register.id_kelas INNER JOIN gender ON gender.id_gender = register.id_gender WHERE id_role=0 ");
	$no = 1;
 ?>
 <body>
 	<?php include '../navbar/nav.php'; ?>
 	<div class="container pt-3 pb-2 mt-3 rounded border border-2 border-light" style="background: linear-gradient(to right,#043927,#078d5f, #043927);">
		<div class="d-flex justify-content-center">
			<input type="" id="cari" onkeyup="cariSiswa()" name="" class="form-control mt-3" style="max-width: 430px" placeholder="Cari siswa ..">
		</div>
		<div class="row container mt-3">
			<a href="dashboard.php" class="text-decoration-none text-white">Dashboard</a>
			<form action="../../route/web.php" method="post">
				<button type="submit" name="deleteAll" class="btn-outline-primary">Hapus Semua</button>
				<button type="submit" name="reverseAll" class="btn-outline-primary">Kembalikan Semua</button>
			</form>
			<a href="tambahkelas.php" class="text-end text-decoration-none text-white">Tambah Kelas</a>

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
				      	<h5><?php echo $key["nama"] ?></h5>
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
				      		<button type="submit" value="<?php echo $key["id_user"]; ?>" name="hapusSiswa" class="btn bg-dark border border-2 border-danger text-danger" onclick="hapusMurid()">Hapus</button>
				      		<button type="submit" value="<?php echo $key["id_user"]; ?>" name="kembalikanSiswa" class="btn bg-dark border border-2 border-danger text-danger">Kembalikan</button>
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