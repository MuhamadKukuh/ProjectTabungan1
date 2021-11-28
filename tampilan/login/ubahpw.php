<?php 
	session_start();

	$id = $_SESSION["ver"];

	// echo $id;
 ?>

 <form action="../../route/web.php" method="post">
 	Masukan Password Baru
 	<input type="password" name="password">
 	<input type="password" name="password2">
 	<button type="submit" value="<?php echo $id; ?>" name="editpw">Kirim</button>
 </form>