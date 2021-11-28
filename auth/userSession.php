<?php 

	if(!isset($_SESSION["auth"])){
		header("Location: ../login/login.php");
	}

	$id    = $_SESSION["auth"];

	$verif = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user=$id");

	$ver   = mysqli_fetch_assoc($verif);

	if ($ver["id_role"] == 1) {
		header("Location: ../dashboard/dashboard.php");
	}
 ?>