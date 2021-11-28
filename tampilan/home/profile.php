<?php 
	session_start();
	include '../../db.php';

	$id   = $_SESSION["auth"];

	$data = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_user = $id");

	$row  = mysqli_fetch_assoc($data);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title></title>
 </head>
 <body id="body2">
 	<?php include '../navbar/nav.php' ?>
    <?php if (isset($_SESSION['berhasil'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Holy guacamole!</strong> You should check in on some of those fields below.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <?php if (isset($_SESSION['berhasil'])): ?>
        <?php unset($_SESSION['berhasil']) ?>
    <?php endif ?>
 	<div class="container mt-3 pt-3 pb-3 rounded">
 		<div class="row">
            <div class="col-3 border-end border-danger">
                <center>
                   <?php if ($row["gambar"] == null){ ?>
                        <img src="<?php echo $row["avatar"]; ?>" class="rounded-circle">
                    <?php }else{ ?>
                        <img src="<?php echo "../../source/".$row["gambar"]; ?>" class="rounded-circle" style="width: 200px; height:200px ;">
                    <?php } ?>
                    
                    <a href="updateprofile.php" class="btn btn-outline-danger mt-4  ">Update Profile</a>
                </center>
            </div>
            <div class="col-8 pt-5 pb-5 text-danger " style="margin-left: 50px">
                <div class="row">
                    <div class="col-4 fw-light">
                        <h3 class="fw-light ">Nama</h3>
                        <h3 class="fw-light mt-1"><?php if ($row["id_role"]) {
                            echo "Wali Kelas";
                        }elseif($row["id_role"]){
                            echo "Kelas";
                        } ?></h3>
                        <h3 class="fw-light mt-1"><?php if ($row["id_role"] == 1 || 3){
                            echo "NIP";
                        }else{
                            echo "NIS";
                        } ?></h3>
                        <h3 class="fw-light mt-1">Jenis Kelamin</h3>
                        <h3 class="fw-light mt-1">No tlp</h3>
                    </div>
                    <div class="col-8 text-start fw-light " >
                        <h3 class="fw-light ">: <?php echo $row["nama"] ?></h3>
                        <h3 class="fw-light mt-1">: <?php echo $row["kelas"] ?></h3>
                        <h3 class="fw-light mt-1">: <?php $nis = sprintf("%s.%s.%s",
                                substr($row["nis"], 0, 4),
                                substr($row["nis"], 4, 2),
                                substr($row["nis"], 6)); 
                                echo $nis ?></h3>
                        <h3 class="fw-light mt-1">: <?php echo $row["gender"] ?></h3>
                        <h3 class="fw-light mt-1">: 0<?php $result = sprintf("%s-%s-%s",
                                substr($row["no_tlp"], 1, 3),
                                substr($row["no_tlp"], 4, 4),
                                substr($row["no_tlp"], 8)); 
                                echo $result ?></h3>
                    </div>
                </div>
            </div>
        </div>
 			
 			
 	</div>
 </body>
 </html>