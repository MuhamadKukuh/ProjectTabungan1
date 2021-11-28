<?php include '../../public/head/head.php'; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm" style="height: 65px;">
  <div class="container-fluid">
<<<<<<< HEAD
    <div>
      <a class="navbar-brand" href="../home/home.php">TabunganQ</a>
      <a class="navbar-brand" href="../dashboard/dashboard.php">Beranda</a>
      <a class="navbar-brand" href="../home/riwayat.php">Riwayat</a>
      <a class="navbar-brand" href="../home/profile.php">Akun</a>
    </div>
=======
    <a class="navbar-brand" href="../home/home.php">TabunganQ</a>
>>>>>>> 987258ebe59fd68e95f1de099c144f7295c6ce73
      <div class="d-flex">
        <div class="collapse navbar-collapse">
          <div class="dropstart ms-3">
            
            <!-- PP 1  -->
            <?php if (isset($_SESSION["auth"])){ ?>
              <?php 
              $id   = $_SESSION['auth'];
              $data = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN gender ON register.id_gender = gender.id_gender WHERE id_user = $id");
              $nama = mysqli_fetch_assoc($data); ?>

            <?php if ($nama["gambar"] == null){ ?>
              <img src="<?php echo $nama ["avatar"] ?>" class="mt-3 mb-2 border border-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown" style="height: 50px; width: 50px; border-radius: 100%;" >
            <?php }else{ ?>
              <img src="<?php echo "../../source/".$nama["gambar"]; ?>" class="mt-3 mb-2 border border-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown" style="height: 50px; width: 50px; border-radius: 100%;" >
            <?php } ?>
            <ul class="dropdown-menu" id="menu-dropdown" aria-labelledby="dropdownMenuButton1">

            <!-- PP Dalam -->
              <!-- Bila gambar tidak ada, tampilkan gambar default (Shiro/Sora) -->
              <center>
                
                <?php if ($nama["gambar"] == null){ ?>
                <img src="<?php echo $nama ["avatar"] ?>" class="mt-3 mb-2 border border-2" style="height: 150px; width: 150px; border-radius: 100%;">
                
                <!-- Bila gambar ada -->
                <?php }else{ ?> 
                <img src="<?php echo "../../source/".$nama["gambar"]; ?>" class="mt-3 mb-2 border border-2"  style="height: 150px; width: 150px; border-radius: 100%;">
                <?php } ?>

              </center>

              <!-- Nama -->
              <li><div class="dropdown-item" id="nama"> <?php echo $nama["nama"]; ?></div></li>

              <!-- Kelas -->
              <li><div class="dropdown-item" id="kelas">Kelas</div></li>
              <hr style="width:100%;" id="line">

              <!-- Profile -->
              <li><a class="dropdown-item" id="profile" href="../home/profile.php">Profil</a></li>

              <!-- Dark Mode -->
              <li class="dropdown-item d-flex" id="dark-mode">Mode Gelap
                <!-- Swith Dark Mode -->
                <div class="form-check form-switch nav-item ms-5" style="color:white;">
                  <input type="checkbox" role="switch" class="form-check-input" id="dark-theme">
                </div>
              </li>
                
              <!-- Home -->
              <?php if ($nama["id_role"] == 2){ ?>
              <li><a class="dropdown-item" id="beranda" href="../home/home.php">Beranda</a></li>
              
              <!-- Dashboard -->
              <?php }elseif($nama["id_role"] == 1 || 3){ ?>
              <li><a href="../dashboard/dashboard.php" class="dropdown-item" calss="text-white">Dashboard</a></li>
              <?php } ?> 

              <!-- Logout -->
              <li><a class="dropdown-item" id="logout" href="../../controller/logout.php">Keluar</a></li>

            </ul>

            <!-- Bila navbar berada di login -->
              <?php }else{ ?>
                <a href="../login/register.php" class="text-decoration-none text-dark">Daftar</a>
             <?php } ?>

          </div>
        </div>
      </div>
    </div>
</nav>

<script type="text/javascript">
  $(document).ready(function(){
    $('#dark-theme').change(function(){
      // Navbar
      $('nav').toggleClass('navbar-dark bg-dark')
        // Dropdown Profile
        $('ul').toggleClass('bg-dark')
          $('#nama').toggleClass('text-light')
          $('#kelas').toggleClass('text-light')
          $('#dark-mode').toggleClass('text-light')
          $('hr').toggleClass('text-light')
          $('#profile').toggleClass('text-white')
          $('#beranda').toggleClass('text-white')
          $('#logout').toggleClass('text-white')
          $('#body2').toggleClass('bg-dark')
      // Body Img
      $('body').toggleClass('bg-img-dark')
    })
  })
</script>


<style type="text/css">
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

