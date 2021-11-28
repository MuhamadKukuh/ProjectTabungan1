<head>
  <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to right,#043927,#078d5f, #043927);">
  <?php include '../navbar/nav.php' ?>
	<div class="container" style="margin-left: 500px;">
		<div class="login-content">
			<form action="../../route/web.php" method="post">
				<h2 class="text-white">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<label for="exampleInputEmail1"></label>
           		   		<input type="email" name="username" class="input" id="exampleInputEmail1" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input form-password" required>
            	   </div>
                 <input type="checkbox" class="form-checkbox"> Show password
            	</div>
            	<a href="verifpw.php" style="text-decoration: none; color: white; ">Forgot Password?</a>
            	<button type="submit" class="btn btn-outline-light" name="login">login</button>
            </form>
        </div>
    </div>
    <script src="../../public/js/jquery-3.6.0.min.js"></script>
    <script src="../../public/js/showpassword.js"></script>
    <script src="../../public/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>