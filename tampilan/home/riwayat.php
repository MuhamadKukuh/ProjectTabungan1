<?php 
  session_start();
  $auth   = $_SESSION['auth'];
  include "../../public/head/head.php";
  include '../../db.php';
  include '../../auth/userSession.php';

  
  $db     = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user = $auth");

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>RIWAYAT</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/riwayat.css">
    <style>
      /* script menghilangkan Horizontal Scroll */
      html, body {
      max-width: 100%;
      overflow-x: hidden;
      }

      .paragraph {
      width: 150%;
      }
</style>
</head>
<body>
    <?php  include "../navbar/nav.php"; ?>
   	<center><h1 class="header">Catatan Keuangan</h1></center>
      <?php 
        $riwayat = mysqli_query($koneksi, "SELECT * FROM riwayat WHERE id_user ='$auth' ORDER BY id_riwayat DESC LIMIT 1");?>
      <?php foreach ($riwayat as $history): ?>
   	    <center>
		    <p class="saldo">Saldo<br><b>Rp <?php echo number_format($history["saldo_akhir"], 0, ".", "."); ?></b></p>
      <?php endforeach ?>
        </center>


     <!-- BUTTON PENGELUARAN & PEMASUKKAN -->
     <div class="container">
     	<div class="row mb-4">
     		<div class="col-5 btn btn-outline-primary">
          <a href="../home/pemasukan.php" style="text-decoration: none;">
     			    <p class="row pengeluaran-pemasukan"><b>Pemasukan</b></p>
              <?php 
                $dor = mysqli_query($koneksi, "SELECT sum(aksi) as total FROM riwayat WHERE id_user ='$auth' AND riwayat='Pengisian' ");

                $total = mysqli_fetch_assoc($dor)?>  
     			    <p class="row pengeluaran-pemasukan-saldo"><b>Rp <?php echo number_format($total["total"], 0, ".", "."); ?></b></p>
          </a>
     		</div>
        <div class="col-2">
          
      </div>
        <div class="col-5 btn btn-outline-primary">
          <a href="../home/pengeluaran.php" style="text-decoration: none;">
              <p class="pengeluaran-pemasukan"><b>Pengeluaran</b></p>
               <?php 
                $apa = mysqli_query($koneksi, "SELECT sum(aksi) as jumlah FROM riwayat WHERE id_user ='$auth' AND riwayat='Penarikan' ");

                $row = mysqli_fetch_assoc($apa); ?>
              <p class="pengeluaran-pemasukan-saldo"><b>Rp <?php echo number_format($row["jumlah"], 0, ".", "."); ?></b></p>
          </a>
        </div>
     	</div>
     </div>

    <div>
      <div class="container fw-bold" style="  max-width: 1800px;">
       <?php 
        $riwayat = mysqli_query($koneksi, "SELECT * FROM riwayat WHERE id_user ='$auth' ORDER BY id_riwayat DESC");?>
        <?php foreach ($riwayat as $key ): ?>
        <div class="row mt-2">
          <div class="col-6">         
            <p style="margin-left: 103px; "><?php echo $key["riwayat"] ?></p>
            <p style="margin-left: 103px; "><?php echo $key["tanggal"]; ?></p>
          </div>
          <div class="col-3" style="  margin-left: 90px;">Rp <?php echo number_format($key["aksi"], 0, ".", "."); ?></div>
          <hr style="margin-left: 114px;">
        </div>
        <?php endforeach ?>
      </div>
    </div>

   <div>
     <div class="container absolute">
       <footer class="py-3 my-4">
         <ul class="nav justify-content-center border-buttom pb-3 mb-3">
           <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
           <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
           <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
           <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
           <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
         </ul>
         <p class="text-center text-muted">© 2021 Company,Inc</p>
       </footer>
     </div>
   </div>
     

</body>
</html>

