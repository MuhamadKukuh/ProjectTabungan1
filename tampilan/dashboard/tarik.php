<?php 
	session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';

	$id = $_POST['id'];

	$siswa = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user = $id");

	$row   = mysqli_fetch_assoc($siswa);

	$dataSaldo = mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user = $id");

	$saldo 	   = mysqli_fetch_assoc($dataSaldo);
 ?>

<h3>Saldo <?php echo $row["nama"]; ?> Sekarang</h3>
<h3>Rp.
	<?php $uang = number_format($saldo["saldo"], 0, ",", ".");
	echo $uang; ?>		
</h3>
<form action="../../route/web.php" method="post">
	<h4>Masukan Jumlah Saldo yang ingin di tarik :</h4>
	<input type="number" name="saldo">
	<button class="btn" value="<?php echo $id; ?>" name="tariksaldo">Konfirmasi</button>
</form>