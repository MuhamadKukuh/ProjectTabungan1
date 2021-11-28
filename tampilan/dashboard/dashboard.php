<?php 
	session_start();
	include '../../db.php';
	include '../../auth/adminSession.php';
	$id = $_SESSION["auth"];

	$parameter = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user='$id' ");
	$row       = mysqli_fetch_assoc($parameter);

	$kelas = $row["id_kelas"];

	if($row["id_role"] == 3){
		$siswas = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_role = 2");

		$saldo = mysqli_query($koneksi, "SELECT sum(saldo) as uang FROM saldo INNER JOIN register ON saldo.id_user = register.id_user INNER JOIN kelas ON kelas.id_kelas = register.id_kelas WHERE register.id_role = 2");

		$penabung = mysqli_query($koneksi, "SELECT * FROM register WHERE id_role=0 ");

	}elseif($row["id_role"] == 1){
		$siswas = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_role = 2 AND register.id_kelas ='$kelas'");

		$saldo = mysqli_query($koneksi, "SELECT sum(saldo) as uang FROM saldo INNER JOIN register ON saldo.id_user = register.id_user INNER JOIN kelas ON kelas.id_kelas = register.id_kelas WHERE register.id_role = 2 AND register.id_kelas='$kelas' ");

		$penabung = mysqli_query($koneksi, "SELECT * FROM konfirmasi INNER JOIN register ON konfirmasi.id_user = register.id_user WHERE register.id_kelas ='$kelas' ");
	}
	
	

	$ttl_penabung= mysqli_num_rows($penabung);

	$total = mysqli_num_rows($siswas);

	$siswa = mysqli_fetch_assoc($siswas);

	$uang   = mysqli_fetch_assoc($saldo);

	$rupiah= number_format($uang["uang"], 0, ",", ".");

 ?>
<body style="background-image: url('https://initiate.alphacoders.com/images/740/cropped-1600-1200-740377.png?4699');">
	<?php include '../navbar/nav.php'; ?>
	<div class="container border border-2 mt-4 pt-2 pb-3 rounded position-absolute top-50 start-50 translate-middle">
			<div class="row mt-3" style="font-family: Comic Sans Ms; color: #AA14F0;">
				<div class="col-4">
					<div class="container border border-2 border-light mt-4 pt-2 pb-3 rounded" style="width:18rem;" >
					  <div class="card-body" >
					    <h3 class="card-title text-center " style="font-weight: bold;">
					    	<?php 
					    	if ($row["id_role"] == 3) {
					    		echo "Total Murid";
					    	}else{
					    		echo "Total Murid ". $siswa["kelas"];
					    	}
					     ?></h3>
					    <h3 class="card-text text-center"><?php echo $total ?></h3>
					    <center>
					    <a href="datasiswa.php" class="btn btn-outline-light">Lihat</a>
					    </center>
					  </div>
					</div>
				</div>
				<div class="col-4">
					<div class="container border border-2 border-light mt-4 pt-2 pb-3 rounded" style="width:18rem; font-weight: bold;" >
					  <div class="card-body" >
					    <h3 class="card-title text-center"><?php 
					    if ($row["id_role"] == 1) {
					     	echo "Saldo";
					     }else{
					     	echo "Total Guru";
					     } ?></h3>
					    <h3 class="card-text text-center"><?php if($row["id_role"] == 3){
					    	$totalguru = mysqli_query($koneksi, "SELECT * FROM register WHERE id_role= 1");
					    	echo mysqli_num_rows($totalguru);
					    }else{
					    	echo "Rp ". $rupiah;
					    } ?></h3>
					    <center>
					    	<?php if ($row["id_role"] == 1){ ?>
					    		<a href="datasaldo.php" class="btn btn-outline-light">Lihat</a>
					    	<?php }else{ ?>
					    		<a href="dataguru.php" class="btn btn-outline-light">Lihat</a>
					    	<?php } ?>
					    </center>
					  </div>
					</div>
				</div>
				<div class="col-4">
					<div class="container border border-2 border-light mt-4 pt-2 pb-3 rounded" style="width:18rem;" >
					  <div class="card-body" >
					    <h5 class="card-title text-center" style="font-weight: bold;"><?php if ($row["id_role"] == 1) {
					    	echo "Penabung Hari ini";
					    }else{
					    	echo "Siswa yang telah di hapus";
					    } ?></h5>
					    <h3 class="card-text text-center"><?php echo $ttl_penabung; ?></h3>
					    <center>
					    	<?php if ($row["id_role"] == 1){ ?>
					    		<a href="listpenabung.php" class="btn btn-outline-light">Lihat</a>
					    	<?php }else{ ?>
					    		<a href="deleteduser.php" class="btn btn-outline-light">Lihat</a>
					    	<?php } ?>
					    </center>
					  </div>
					</div>
				</div>
			</div>
	</div>
</body>