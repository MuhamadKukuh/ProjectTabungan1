<?php 
 include '../controller/adminController.php';
 include '../controller/userController.php';
 include '../controller/superController.php';

if (isset($_POST['tariksaldo'])) {
	tarikSaldo($_POST);
}

if (isset($_POST["tambahkelas"])) {
	tambahKelas($_POST);
}

if (isset($_POST["hapuskelas"])) {
	hapusKelas($_POST);
}

if (isset($_POST["hapussiswa"])) {
	hapusSiswa($_POST);
}

if (isset($_POST["tambahsaldo"])) {
	tambahSaldo($_POST);
}

if (isset($_POST["updatekelas"])) {
	updateKelas($_POST);
}

include '../controller/authController.php';

if (isset($_POST["login"])) {
	Login($_POST);
}

if (isset($_POST["register"])) {
	userRegister($_POST);
}

if (isset($_POST["nabung"])) {
	nabung($_POST);
}

if (isset($_POST["updateprofile"])) {
	updateProfile($_POST);
}

if (isset($_POST["ubahpw"])) {
	ubahPw($_POST);
}

if (isset($_POST["editpw"])) {
	editPw($_POST);
}

// Buat super admin sama Admin Ada di controller super

if (isset($_POST['lihatRiwayat'])) {
	lihatRiwayat($_POST);
}

// Super admin

if (isset($_POST['tambahGuru'])) {
	tambahGuru($_POST);
}

if (isset($_POST["reverseAll"])) {
	reverseAll();
}

if (isset($_POST["deleteAll"])) {
	deleteAll();
}

if (isset($_POST["hapusSiswa"])) {
	deleteSiswa($_POST);
}

if (isset($_POST["kembalikanSiswa"])) {
	kembalikanSiswa($_POST);
}
if (isset($_POST["hapusguru"])) {
	hapusGuru($_POST);
}
 ?>

