<?php 
	$db = mysqli_connect("localhost", "root", "", "latihan");

	function tarikSaldo($data){
		global $db;

		$id 	= $data["tariksaldo"];
		$saldo  = $data["saldo"];

		$dataSaldo = mysqli_query($db, "SELECT * FROM saldo WHERE id_user = $id");

		$row 	   = mysqli_fetch_assoc($dataSaldo);

		if ($saldo < 0) {
			echo "<script>
			alert('Target pasarnya bukan anda!');
			document.location = '../tampilan/dashboard/tarik.php'
			</script>";

			exit;
		}elseif ($saldo > $row["saldo"] ) {
			echo "<script>
			alert('Target pasarnya bukan anda');
			document.location = '../tampilan/dashboard/tarik.php'
			</script>";
			exit;
		}elseif($row["saldo"] >= $saldo ) {
			$saldo2 = $row["saldo"];
			$kurang = $saldo2 - $saldo;
			$date   = date("Y-m-d");
			$history = mysqli_query($db, "INSERT INTO riwayat(`riwayat`, `tanggal`, `id_user`, `saldo_asal`, `aksi`, `saldo_akhir`) VALUES ('Penarikan', '$date', '$id', '$saldo2', '$saldo', '$kurang') ");
			if ($history) {
				$update = mysqli_query($db, "UPDATE saldo SET saldo='$kurang' WHERE id_user = $id");
				if ($update) {
					echo "<script>
					alert('Tabungan berhasil ditark');
					document.location= '../tampilan/dashboard/dashboard.php'
					</script>";
				}
			}else{
				echo "<script>
				alert('Lagi error keknya');
				document.location = '../tampilan/dashboard/tarik.php'
				</script>";
			}
		}else{
			echo "<script>
			alert('Lagi error keknya');
			document.location = '../tampilan/dashboard/tarik.php'
			</script>";
		}
	}

	function tambahKelas($data){
		global $db;

		$kelas = $data["kelas"];

		$tambahKelas = mysqli_query($db, "INSERT INTO kelas(`kelas`) VALUES ('$kelas') ");

		if($tambahKelas){
			echo "<script>
			alert('Penambahan Kelas Berhasil');
			document.location = '../tampilan/dashboard/tambahkelas.php'
			</script>";
		}else{
			echo "<script>
			alert('Lagi error keknya');
			document.location = '../tampilan/dashboard/tambahkelas.php'
			</script>";
		}
	}
	function hapusKelas($data){
		global $db;

		$id 	= $data["hapuskelas"];

		$destroy= mysqli_query($db, "DELETE FROM kelas WHERE id_kelas = $id");

		if($destroy){
			echo "<script>
			alert('Hapus Kelas Berhasil');
			document.location = '../tampilan/dashboard/tambahkelas.php'
			</script>";
		}else{
			echo "<script>
			alert('Lagi erro keknya');
			document.location = '../tampilan/dashboard/tambahkelas.php'
			</script>";
		}
	}

	function hapusSiswa($data){
		global $db;

		$id 	= $data["hapussiswa"];

		$destroy= mysqli_query($db, "UPDATE register SET id_role=0 WHERE id_user = $id");

		if($destroy){
			echo "<script>
			alert('Hapus Murid Berhasil');
			document.location = '../tampilan/dashboard/datasiswa.php'
			</script>";
		}else{
			echo "<script>
			alert('Penambahan Murid Gagal');
			document.location = '../tampilan/dashboard/datasiswa.php'	
			</script>";
		}

	}

	function tambahSaldo($data){
		global $db;

		$id = $data["tambahsaldo"];

		$dataKonfirmasi = mysqli_query($db, "SELECT * FROM konfirmasi WHERE id_konfirmasi = $id");

		if(mysqli_num_rows($dataKonfirmasi) === 1){
			$row 	= mysqli_fetch_assoc($dataKonfirmasi);
			$saldo  = $row["uang"];
			$iduser = $row["id_user"];
			$date   = $row["date"];

			$datasaldo = mysqli_query($db, "SELECT * FROM saldo WHERE id_user = $iduser");

			if(mysqli_num_rows($datasaldo) === 1){

				$row2   = mysqli_fetch_assoc($datasaldo);
				$saldo2 = $row2["saldo"];
				$tambah = $saldo + $saldo2;

				$riwayat= mysqli_query($db, "INSERT INTO riwayat(`riwayat`, `tanggal`, `id_user`, `saldo_asal`, `aksi`, `saldo_akhir`) VALUES ('Pengisian', '$date', '$iduser', '$saldo2', '$saldo', '$tambah')");

				if ($riwayat) {
					$update = mysqli_query($db, "UPDATE saldo SET saldo='$tambah' WHERE
					id_user = $iduser ");

					$hapus = mysqli_query($db, "DELETE FROM konfirmasi WHERE id_konfirmasi = $id");
					if ($update && $hapus) {
						echo "<script>alert('Tabungan Berhasil Ditambah')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
					}else {
						echo "<script>alert('Lagi Error keknya')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
					}
				}else {
					echo "<script>alert('Lagi Error Keknya')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
				}
			}elseif(mysqli_num_rows($datasaldo) === 0) {
				$riwayat= mysqli_query($db, "INSERT INTO riwayat(`riwayat`, `tanggal`, `id_user`, `saldo_asal`, `aksi`, `saldo_akhir`) VALUES ('Pengisian', '$date', '$iduser', '0', '$saldo', '$saldo')");
				$hapus1   = mysqli_query($db, "DELETE FROM konfirmasi WHERE id_konfirmasi = $id");

				if ($riwayat & $hapus1) {
					$masukan = mysqli_query($db, "INSERT INTO saldo(`saldo`, `id_user`) VALUES ('$saldo', '$iduser')");

					echo "<script>alert('Tabungan Berhasil Di tambahkan')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
				}else{
					echo "<script>alert('Data tidak di temukan')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
				}
			}else {
				echo "<script>alert('Data tidak di temukan')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
			}
		}else {
			echo "<script>alert('Data tidak di temukan')
						document.location = '../tampilan/dashboard/listpenabung.php'
						</script>";
		}
	}

	function updateKelas($data){
		global $db;

		$id = $data['updatekelas'];
		$kelas = $data["kelas"];

		$datakelas = mysqli_query($db, "SELECT * FROM kelas WHERE id_kelas = $id");

		if (mysqli_num_rows($datakelas) === 1) {
			$row = mysqli_fetch_assoc($datakelas);
			if($row){
				$update = mysqli_query($db, "UPDATE kelas SET kelas='$kelas' WHERE id_kelas ='$id' ");

				if ($update) {
					echo "<script>
					alert('Kelas Berhasil Di ubah');
					document.location = '../tampilan/dashboard/tambahkelas.php'
					</script>";
				}
			}
		}
	}


?>