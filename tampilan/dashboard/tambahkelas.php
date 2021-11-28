<?php 
    session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';

	$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
 ?>
<body>
	<?php include '../navbar/nav.php'; ?>

	<div class="container mt-4 pb-3 pt-3 border-light border border-2">
		<a href="dashboard.php" class="text-decoration-none">Dashboard</a>
		<h3 class="f-b">
			Kelas Yang Sudah ada
		</h3>
		<table>
			<thead class="table">
				<tr>
					<th>Kelas</th>
					<th>Hapus</th>
					<th>EDIT</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($kelas as $key): ?>
					<tr>
						<td><?php echo $key["kelas"]; ?></td>
						<td>
							<form action="../../route/web.php" method="post">
								<button class="btn bg-dark text-danger border border-2 border-danger" name="hapuskelas" value="<?php echo $key["id_kelas"]; ?>" type="submit">Hapus</button>
							</form>
						</td>
						<td>
							<form action="editkelas.php" method="post">
								<button class="btn bg-dark text-danger border border-2 border-danger" name="editkelas" value="<?php echo $key["id_kelas"]; ?>" type="submit">Edit</button>
							</form>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		

		<h5>Tambahkan Kelas :</h5>
		<form action="../../route/web.php" method="post">
			<input type="text" name="kelas">
			<button type="submit" name="tambahkelas">Konfirmasi</button>
		</form>
	</div>
</body>