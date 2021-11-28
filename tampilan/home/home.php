<?php 
	session_start();

	include '../../db.php';
	include '../../auth/userSession.php';

	$auth   = $_SESSION['auth'];

	$db     = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user = '$auth'");

	$saldo  = mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user = '$auth'");

	if (mysqli_num_rows($saldo) === 1) {
		$uang   = mysqli_fetch_assoc($saldo);

		$format = number_format($uang["saldo"], 0, ",", ".");
	}else{
		$format = 0;
	}
	
	$no=1;

 ?>

<!-- BG -->
<link rel="stylesheet" type="text/css" href="../../public/css/main.css">
<body class="bg-img">


<!-- Toast -->
	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
	  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-header">
	      <img src="../../source/aset/main-icon.png" style="width: 50px;" class="rounded me-2" alt="...">
	      <strong class="me-auto">TabunganQ</strong>
	      <small>Baru saja</small>
	      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	    </div>
	    <div class="toast-body">
	      Permintaan sedang dalam antrian.
	      <a href="#" id="detail-toast">detail</a>
	    </div>
	  </div>
	</div>

<?php include '../navbar/nav.php'; ?>
	<div class="bg-dark rounded mt-4 container text-light border border-2 pt-3 pb-3">	
		<h3 style="font-family: Comic Sans Ms">Rp. <?php echo $format ?></h3>
		Isi Saldo | <a href="riwayat.php">Riwayat</a>
		<form id="main" action="../../route/web.php" method="post">
			<h3>Saldo : </h3>
			<input type="number" class="form-control" name="saldo" required>
			<h3 class="mt-4">Pesan :</h3>
			<textarea class="form-control " name="pesan" required>
			</textarea>
			<center>
				<button type="submit" class="mt-2 btn btn-outline-light" name="nabung" value="
				<?php echo $auth; ?>">Kirim</button>
				<!-- Toast Show -->
					<?php if ('$auth'){ ?>
						<script type="text/javascript">$('#ya').on('click',function(){
							  $('#liveToast').toast('show');
							  $('#main')[0].reset()
							})
						</script>
					<?php } ?>
					
			</center>
		</form>
	</div>

	<div >
     <div class="container absolute" >
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