<?php 
	session_start();

	$id = $_SESSION["auth"];
 ?>

<form action="../../route/web.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<button type="submit" name="updateprofile" value="<?php echo $id; ?>">Upload</button>
</form>