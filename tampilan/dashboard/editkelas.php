<?php 
	session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';
	
	$id = $_POST['editkelas'];

	$datakelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas = $id ");
	$kelas = mysqli_fetch_assoc($datakelas);
 ?>

Ubah kelas :
 <form action="../../route/web.php" method="post">
 	<input type="text" name="kelas" value="<?php echo $kelas["kelas"]; ?>">
 	<button type="submit" name="updatekelas" value="<?php echo $kelas["id_kelas"] ?>">Update</button>
 </form> 