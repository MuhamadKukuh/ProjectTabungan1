<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>regist</title>
	<?php include '../../public/head/head.php' ?>
	<link rel="stylesheet" type="text/css" href="../../public/Bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/css/register.css">
</head>

<?php 
	include '../../db.php';

	$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
	$gender= mysqli_query($koneksi, "SELECT * FROM gender");
 ?>

<nav class="navbar navbar-light navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bolder t">Tabungan | Q</a>
  </div>
  <div class="mt-2 fn-login">
			<a href="" class="text-white">login</a>
	</div>
</nav>
<body class="bg-primary"> 
	<h2 class="fw-bold text-white" style="margin-left: 20px;">REGISTRASI!</h2>
   <div class="login-box">
<form action="../../route/web.php" method="post">
	Username<input type="email" name="username"><br><br>
	Password<input type="password" name="password"><br><br>
	Konfirmasi password<input type="password" name="password2"><br><br>
	Nama<input type="text" name="nama"><br><br>
	No_tlp +62<input type="number" name="tlp"><br><br>
	NIS<input type="number" name="nis"><br><br>
	<select name="kelas">
		<?php foreach($kelas as $key): ?>
			<option value="<?php echo $key["id_kelas"] ?>"><?php echo $key["kelas"] ?></option>
		<?php endforeach ?>
	</select>
	<select name="gender">
		<?php foreach($gender as $gen): ?>
			<option value="<?php echo $gen["id_gender"] ?>"><?php echo $gen["gender"] ?></option>
		<?php endforeach ?>
	</select>
	<button type="submit" name="register">Register</button>
</form>
   </div>
</body>
<div style="margin-top: 700px;">
<div class="container absolute">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">About</a></li>
    </ul>
    <p class="text-center text-white">© 2021 Company, Inc</p>
  </footer>
</div>
</div>
</html>