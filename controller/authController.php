<?php 
	include '../db.php';

	function Login($data){
		global $koneksi;

		$username = $data['username'];
	  	$password = $data['password'];

		$data	= mysqli_query($koneksi, "SELECT * FROM register WHERE username= '$username' ");

		  if ( mysqli_num_rows($data) === 1) {
		  	session_start();
		  	$row = mysqli_fetch_assoc($data);

		  	$passwordVer = password_verify($password, $row["password"]);

		  	if($row["id_role"] == 1){
		  		if($passwordVer){
		  			$_SESSION['auth'] = $row["id_user"];
		  			header("Location: ../tampilan/dashboard/dashboard.php");
		  			exit;
		  		}else{
		  			echo "<script>
			  		alert('Saha Sia?!!!');
			  		document.location= '../tampilan/login/login.php'
			  		</script>";
		  		}
		  	}elseif($row["id_role"] == 2){
		  		if($passwordVer){
		  			$_SESSION['auth'] = $row["id_user"];
		  			header("Location: ../tampilan/home/home.php");
		  		}else{
		  			echo "<script>
			  		alert('Saha Sia?!!!');
			  		document.location= '../tampilan/login/login.php'
			  		</script>";
		  		}
		  	}elseif ($row["id_role"] == 3 ) {
		  		if ($passwordVer) {
		  			$_SESSION["auth"] = $row["id_user"];
		  			header("Location: ../tampilan/dashboard/dashboard.php");
		  		}else{
		  			echo "<script>
			  		alert('Saha Sia?!!!');
			  		document.location= '../tampilan/login/login.php'
			  		</script>";
		  		}
		  	}else {
		  		echo "<script>
		  		alert('Saha Sia?!!!');
		  		document.location= '../tampilan/login/login.php'
		  		</script>";
		  	}

		  }else {
		  	echo "<script>
		  	alert('Akun tidak ditemukan');
		  	document.location= '../tampilan/login/login.php'
		  	</script>";
		  }


		}

	function userRegister($data){
		global $koneksi;

		$username = $data["username"];
		$password = $data["password"];
		$password2= $data["password2"];
		$nama 	  = $data["nama"];
		$nis 	  = $data["nis"];
		$tlp 	  = $data["tlp"];
		$idgender = $data["gender"];
		$idkelas  = $data["kelas"];
		$idrole	  = 2;

		$hash     = password_hash($password, PASSWORD_DEFAULT);

		if($password !== $password2){
			echo "<script>
			alert('Password Tidak Cocok');
			document.location= '../tampilan/login/register.php'
			</script>";

			exit;
		}elseif (strlen($password) < 5) {
			echo "<script>
			alert('Password Minimal 5 kata');
			document.location= '../tampilan/login/register.php'
			</script>";

			exit;
		}elseif (strlen($tlp) < 12 ) {
			echo "<script>
			alert('No tlp Minimal 12');
			document.location= '../tampilan/login/register.php'
			</script>";

			exit;
		}

		$datauser = mysqli_query($koneksi, "SELECT username FROM register WHERE username= '$username' ");
		
		$datatlp  = mysqli_query($koneksi, "SELECT no_tlp FROM register WHERE no_tlp = '$tlp'");

		$datanis  = mysqli_query($koneksi, "SELECT nis FROM register WHERE nis = '$nis' ");

		if (mysqli_fetch_assoc($datauser)) {
			echo "<script>alert('Username telah digunakan');
			document.location= '../tampilan/login/register.php'
			</script>";

			exit;
		}elseif (mysqli_fetch_assoc($datatlp)) {
			echo "<script>alert('No tlp telah digunakan');
			document.location= '../tampilan/login/register.php'
			</script>";

			exit;
		}elseif (mysqli_fetch_assoc($datanis)) {
			echo "<script>alert('NIS telah digunakan');
			document.location= '../tampilan/login/register.php'
			</script>";

			exit;
		}else{
			$tambah = mysqli_query($koneksi, "INSERT INTO register(`nama`, `username`, `password`, `id_kelas`, `no_tlp`, `nis`, `id_gender`, `id_role`) VALUES ('$nama', '$username', '$hash', '$idkelas', '$tlp', '$nis', '$idgender', '$idrole') ");
			header("Location: ../tampilan/login/login.php");
		}

	}

	function ubahPw($data){
		global $koneksi;

		$username = $data["username"];
		$tlp      = $data["tlp"];

		session_start();

		$dataUser 	  = mysqli_query($koneksi, "SELECT * FROM register WHERE username='$username' ");

		if (mysqli_num_rows($dataUser) === 1) {
			$row  = mysqli_fetch_assoc($dataUser);
			if ($row["no_tlp"] == $tlp) {
				$_SESSION['ver'] = $row["id_user"];
			    header("Location: ../tampilan/login/ubahpw.php");
			}else{
				echo "<script>
				alert('no tlp tidak ditemukan');
				document.location= '../tampilan/login/verifpw.php'
				</script>";
			}
		}else{
			echo "<script>
			alert('username tidak ditemukan');
			document.location= '../tampilan/login/verifpw.php'
			</script>";
		}
	}

	function editPw($data){
		global $koneksi;

		$id 	  = $data["editpw"];
		$password = $data["password"];
		$password2= $data["password2"];

		if ($password !== $password2) {
			echo "<script>
			alert('Password tidak sesuai');
			document.location= '../tampilan/login/ubahpw.php'
			</script>";

			exit;
		}else{
			$hash = password_hash($password, PASSWORD_DEFAULT);
		}

		$ubahPw = mysqli_query($koneksi, "UPDATE register SET password='$hash' WHERE id_user = $id");

		if ($ubahPw) {
			echo "<script>
			alert('Password berhasil diubah');
			document.location= '../tampilan/login/login.php'
			</script>";
		}else{
			echo "<script>
			alert('lagi error keknya');
			document.location= '../tampilan/login/ubahpw.php'
			</script>";
		}
	}
	
 ?>

