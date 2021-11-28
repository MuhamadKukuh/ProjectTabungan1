<?php 
	session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';

	$id = $_SESSION["auth"];

	$query = mysqli_query($koneksi, "SELECT	* FROM	register WHERE	id_user='$id'");

	$row = mysqli_fetch_assoc($query);

	$kelas = $row["id_kelas"];


	$list = mysqli_query($koneksi, "SELECT * FROM konfirmasi INNER JOIN register ON konfirmasi.id_user = register.id_user INNER JOIN kelas ON register.id_kelas = kelas.id_kelas WHERE register.id_role= 2 AND register.id_kelas = '$kelas' ORDER BY id_konfirmasi DESC");

	$coba = mysqli_query($koneksi, "SELECT * FROM kelas ");

	$row  = mysqli_fetch_assoc($coba);
 ?>
 
<body>
	<?php include '../navbar/nav.php'; ?>
	<div class="mt-4">
		<table class="table">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Nis</th>
					<th>Pesan</th>
					<th>Kelas</th>
					<th>Tanggal</th>
					<th>Nabung</th>
					<th>Konfirm</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $key ): ?>
					<tr>
						<td><?php echo $key["nama"]; ?></td>
						<td><?php echo $key["nis"] ?></td>
						<td>
							<p><?php echo $key["pesan"] ?></p>
						</td>
						<td><?php echo $key["kelas"] ?></td>
						<td><?php echo $key["date"] ?></td>
						<td>Rp <?php echo number_format($key["uang"], 0,".","."); ?></td>
						<td>
							<form action="../../route/web.php" method="post">
						    	<button class="btn btn-dark border border-2 border-danger text-danger" type="submit" value="<?php echo $key["id_konfirmasi"]; ?>" name="tambahsaldo">Konfirmasi</button>
						    </form>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>