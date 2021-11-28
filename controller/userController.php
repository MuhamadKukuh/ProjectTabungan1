<?php 
	include '../db.php';

	function nabung($data){
		global $koneksi;

		$id = $data["nabung"];
		$saldo = $data["saldo"];
		$pesan = $data["pesan"];

		if ($saldo <= 0 ){
			echo "<script>
			alert('Mau ngapain Kau??');
			document.location= '../tampilan/home/home.php'
			</script>";
		}else{
			$date = date("Y-m-d");
			$kirim = mysqli_query($koneksi, "INSERT INTO konfirmasi(`id_user`, `pesan`, `uang`, `date`) VALUES ('$id', '$pesan', '$saldo', '$date')");

			header("Location: ../tampilan/home/home.php");
		}


	}

	function updateProfile($data){
		global $koneksi;

			$id 	= $data["updateprofile"];

			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$nama = $_FILES["file"]["name"];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){		
					move_uploaded_file($file_tmp, '../source/'.$nama);
					$query = mysqli_query($koneksi,"UPDATE register SET gambar='$nama' WHERE id_user=$id");

					if($query){
						session_start();
						$_SESSION['berhasil'] = true;
						header("Location: ../tampilan/home/profile.php");
					}else{
						echo "<script>
						alert('file Gagal Di upload');
						document.location='../tampilan/updateprofile.php'
						</script>";
					}
				}else{
					echo "<script>
						alert('file terlalu besar');
						document.location='../tampilan/home/updateprofile.php'
						</script>";
				}
			}else{
				echo "<script>
						alert('Tipe file harus gambar');
						document.location='../tampilan/updateprofile.php'
						</script>";
			}
	}
 ?>