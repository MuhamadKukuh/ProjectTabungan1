<?php 
    session_start();
	include '../../db.php';
	include '../../auth/superAdminSession.php';
	$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
	$gender = mysqli_query($koneksi, "SELECT * FROM gender");
 ?>
 <body>
 	<?php include '../navbar/nav.php'; ?>
 	<form action="../../route/web.php" method="post" class="container">
 		Username : <br>
 		<input type="email" name="username" required><br>
 		Password : <br>
 		<input type="password" name="password" required><br>
 		Verif Password : <br>
 		<input type="password" name="password2" required><br>
 		Nama : <br>
 		<input type="text" name="nama" required><br>
 		NIP : <br>
 		<input type="number" name="nis" required><br>
 		No tlp : <br>
 		<input type="number" name="tlp" required><br>
 		Wali Kelas : <br>
 		<select name="kelas"> <br>
 			<?php foreach ($kelas as $key ): ?>
 				<option value="<?php echo $key["id_kelas"] ?>"><?php echo $key["kelas"] ?></option>
 			<?php endforeach ?>
 		</select>
 		<select name="gender">
 			<?php foreach ($gender as $gend ): ?>
 				<option value="<?php echo $gend["id_gender"] ?>"><?php echo $gend["gender"] ?></option>
 			<?php endforeach ?>
 		</select><br>
 		<button type="submit" name="tambahGuru" class="btn btn-outline-primary mt-2">Kirim</button>
 	</form>
 </body>