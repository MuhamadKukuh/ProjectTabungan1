<?php 
	
	// Database
	include '../db.php';

	function tambahGuru($data){
		global $koneksi;

		$username = $data["username"];
		$password = $data["password"];
		$password2= $data["password2"];
		$nama 	  = $data["nama"];
		$nis 	  = $data["nis"];
		$tlp 	  = $data["tlp"];
		$idgender = $data["gender"];
		$idkelas  = $data["kelas"];
		$idrole	  = 1;

		$hash     = password_hash($password, PASSWORD_DEFAULT);

		if($password !== $password2){
			echo "<script>
			alert('Password Tidak Cocok');
			document.location= '../tampilan/dashboard/tambahguru.php'
			</script>";

			exit;
		}elseif (strlen($password) < 5) {
			echo "<script>
			alert('Password Minimal 5 kata');
			document.location= '../tampilan/dashboard/tambahguru.php'
			</script>";

			exit;
		}elseif (strlen($tlp) < 12 ) {
			echo "<script>
			alert('No tlp Minimal 12');
			document.location= '../tampilan/dashboard/tambahguru.php'
			</script>";

			exit;
		}

		$datauser = mysqli_query($koneksi, "SELECT username FROM register WHERE username= '$username' ");
		
		$datatlp  = mysqli_query($koneksi, "SELECT no_tlp FROM register WHERE no_tlp = '$tlp'");

		if (mysqli_fetch_assoc($datauser)) {
			echo "<script>alert('Username telah digunakan');
			document.location= '../tampilan/dashboard/tambahguru.php'
			</script>";

			exit;
		}elseif (mysqli_fetch_assoc($datatlp)) {
			echo "<script>alert('No tlp telah digunakan');
			document.location= '../tampilan/dashboard/tambahguru.php'
			</script>";

			exit;
		}else{
			$tambah = mysqli_query($koneksi, "INSERT INTO register(`nama`, `username`, `password`, `id_kelas`, `no_tlp`, `nis`, `id_gender`, `id_role`) VALUES ('$nama', '$username', '$hash', '$idkelas', '$tlp', '$nis', '$idgender', '$idrole') ");

			session_start();

			$_SESSION['success'] = true;

			header("Location: ../tampilan/dashboard/dataguru.php");
		}

	}

	function lihatRiwayat($data){
		global $koneksi;

		$id = $data["lihatRiwayat"];

		session_start();
		$_SESSION['lihatRiwayat'] = $id;

		header("Location: ../tampilan/dashboard/riwayatsiswa.php");
	}

	function reverseAll(){
		global $koneksi;

		$kembalikan = mysqli_query($koneksi, "UPDATE register SET id_role=2 WHERE id_role = 0");

		if ($kembalikan) {
			echo "<script>alert('Siswa telah di kembalikan');
			document.location= '../tampilan/dashboard/deleteduser.php'
			</script>";
		}else{
			header("Location: ../tampilan/dashboard/deleteduser.php");
		}
	}

	function deleteAll(){
		global $koneksi;

		$hapus = mysqli_query($koneksi, "DELETE FROM register WHERE id_role = 0");

		if ($hapus) {
			echo "<script>alert('Siswa telah di hapus semua');
			document.location= '../tampilan/dashboard/deleteduser.php'
			</script>";
		}else{
			header("Location: ../tampilan/dashboard/deleteduser.php");
		}
	}

	function deleteSiswa($data){
		global $koneksi;
		$id = $data["hapusSiswa"];


		$hapus = mysqli_query($koneksi, "DELETE FROM register WHERE id_user='$id' ");

		if ($hapus) {
			echo "<script>alert('Siswa telah di hapus');
			document.location= '../tampilan/dashboard/deleteduser.php'
			</script>";
		}else{
			header("Location: ../tampilan/dashboard/deleteduser.php");
		}
	}

	function kembalikanSiswa($data){
		global $koneksi; 
		$id = $data["kembalikanSiswa"];

		$update = mysqli_query($koneksi, "UPDATE register SET id_role=2 WHERE id_user='$id' ");

		if ($update) {
			echo "<script>alert('Siswa berhasil di kembalikan');
			document.location= '../tampilan/dashboard/deleteduser.php'
			</script>";
		}else{
			header("Location: ../tampilan/dashboard/deleteduser.php");
		}
	}

	function hapusGuru($data){
		global $koneksi;
		$id = $data["hapusguru"];

		$destroy = mysqli_query($koneksi, "UPDATE register SET id_role=0 WHERE id_user='$id'");

		if($destroy){
			echo "<script>
			alert('Hapus Guru Berhasil');
			document.location = '../tampilan/dashboard/dataguru.php'
			</script>";
		}else{
			echo "<script>
			alert('Hapus Guru Gagal');
			document.location = '../tampilan/dashboard/dataguru.php'	
			</script>";
		}
	}


 ?>