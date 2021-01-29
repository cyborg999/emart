<?php 
  include_once "./model.php";

  $model = new Model();
	$err = $model->getErrors();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>eMart</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./css/style.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style type="text/css">
  	#header {
  		background: rgba(30, 67, 86, 0.8)!important;
  	}
  	#features {
  		min-height: 100vh;
  	}
  	#features .container {
  		min-height: 70vh;
  	}
  	.features .row + .row {
  		margin-top: 10px;
  	}
  	.float-right {
  		float: right;
  		margin-right: 100px;
  	}
.form-group {
	margin: 20px 0;
}
  </style>
</head>

<body>
	  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>BakedPH</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <!-- <li><a href="">About Us</a></li> -->
          <li><a href="signup.php">Sign Up</a></li>
          <li class="active"><a href="login.php">Login</a></li>
         
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Features Section ======= -->
    <section  id="features" class="features">
      <div class="container">
      <?php
        $setting = $model->getAdminSetting(true);
        echo $setting[$_GET['page']];
      ?>
			</div>
    </section><!-- End Features Section -->
    <br>
    <br>
  </main><!-- End #main -->

 <script type="text/javascript">
	   	function setDefaultDate(){
	   		var now = new Date();

			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);

			var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

			var dateInput = $("input[type='date']");

			dateInput.val(today);
	   	}		
	   	
	   	setDefaultDate();
    </script>
  <?php include "./footer2.php"; ?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  	<script type="text/javascript">
		(function($){
			
		})(jQuery);
	</script>
</body>

</html>