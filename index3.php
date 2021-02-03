<?php 
if(isset($_POST['REDIRECT'])){
    header("Location: success.php");
}
    include_once "./model.php";

    $model = new Model();
    $err = $model->getErrors();
  // $logo = $model->getLogo();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>eMart</title>

	<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
	<meta name="description" content="ui library for front-end developers to create online shor templates">
	<meta name="keywords" content="ui kit, ecommerce templates, website, e-commerce, uikit framework, HTML, CSS, Bootstrap 4">
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

	<!-- Bootstrap-ecommerce -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >

	<!-- <link rel="stylesheet" type="text/css" href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/bootstrap.css?v=2.0"> -->
	<link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/ui.css?v=2.0" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.css" >
	<!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/responsive.css?v=2.0" rel="stylesheet"> -->

	<!-- fonticon -->
	<!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/fonts/fontawesome/css/all.min.css?v=2.0" type="text/css" rel="stylesheet"> -->

	<!-- Custom styling -->
	<link href="https://bootstrap-ecommerce.com/assets/css/style.css?v=2.0" rel="stylesheet">
</head>
<body>
	<style type="text/css">
		.container-fluid {
			padding: 0;
			margin: 0 auto;
		}
	</style>
	<div class="container-fluid">
		<header class="section-header">
			<section class="header-top-light border-bottom">
			  <div class="container">
			    <nav class="d-flex flex-column flex-md-row">
			      <ul class="nav mr-auto d-none d-md-flex">
			        <li><a href="#" class="nav-link px-2"> <i class="fa fa-facebook"></i> </a></li>
					<li><a href="#" class="nav-link px-2"> <i class="fa fa-instagram"></i> </a></li>
					<li><a href="#" class="nav-link px-2"> <i class="fa fa-twitter"></i> </a></li>
			      </ul>
			      <ul class="nav">
			        <li class="nav-item"><a href="#" class="nav-link"> Delivery </a></li>
					<li class="nav-item"><a href="#" class="nav-link"> Help </a></li>
					<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> USD </a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a class="dropdown-item" href="#">EUR</a></li>
							<li><a class="dropdown-item" href="#">AED</a></li>
							<li><a class="dropdown-item" href="#">RUBL </a></li>
			            </ul>
					</li>
			        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">   Language </a>
			            <ul class="dropdown-menu dropdown-menu-right">
							<li><a class="dropdown-item" href="#">English</a></li>
							<li><a class="dropdown-item" href="#">Arabic</a></li>
							<li><a class="dropdown-item" href="#">Russian </a></li>
			            </ul>
			        </li>
			      </ul> <!-- navbar-nav.// -->
			    </nav>
			  </div>
			</section>

			<section class="header-main border-bottom">
				<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-3 col-sm-4 col-12">
					<a href="http://bootstrap-ecommerce.com" class="brand-wrap">
						<style type="text/css">
							#logo {
								background: url(./images/logo.png) no-repeat;
								background-size: contain;
								width: auto;
								height: 30px;
							}
							body {
								background: #f8f9fa;
							}
							header {
								background: white;
							}
						</style>
						<figure id="logo"></figure>
					</a> <!-- brand-wrap.// -->
					</div>
					<div class="col-lg-4 col-xl-5 col-sm-8 col-12">
						<form action="#" class="search">
							<div class="input-group w-100">
							    <input type="text" class="form-control" style="width:55%;" placeholder="Search">
							    <div class="input-group-append">
							      <button class="btn btn-primary" type="submit">
							        <i class="fa fa-search"></i>
							      </button>
							    </div>
						    </div>
						</form> <!-- search-wrap .end// -->
					</div> <!-- col.// -->
					<div class="col-lg-5 col-xl-4 col-sm-12">
						<div class="widgets-wrap float-md-right">
							<a href="cart.php" class="widget-header mr-2">
								<div class="icon">
									<i class="icon-sm rounded-circle border fa fa-shopping-cart"></i>
									<span class="notify">0</span>
								</div>
							</a>
							<a href="wishlist.php" class="widget-header mr-2">
								<div class="icon">
									<i class="icon-sm rounded-circle border fa fa-heart"></i>
								</div>
							</a>
							<div class="widget-header dropdown">
								<a href="#" data-toggle="dropdown" data-offset="20,10">
									<div class="icontext">
										<?php if(isset($_SESSION['id'])): ?>
                                    <!-- <li class="list-inline-item"><a href="<?= $url;?>"><img src="./index_files/user.png" alt="">My Account</a></li> -->
                                <?php endif ?>
										<a href="userdashboard.php">
											<div class="icon">
											<i class="icon-sm rounded-circle border fa fa-user"></i>
										</div>
										</a>
										
										<div class="text">
											<small class="text-muted"><a href="login.php">Sign in</a> | <a href="signup.php">Join</a></small>
											<div>My account <i class="fa fa-caret-down"></i> </div>
										</div>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<form class="px-4 py-3">
										<div class="form-group">
										  <label>Email address</label>
										  <input type="email" class="form-control" placeholder="email@example.com">
										</div>
										<div class="form-group">
										  <label>Password</label>
										  <input type="password" class="form-control" placeholder="Password">
										</div>
										<button type="submit" class="btn btn-primary">Sign in</button>
										</form>
										<hr class="dropdown-divider">
										<a class="dropdown-item" href="#">Have account? Sign up</a>
										<a class="dropdown-item" href="#">Forgot password?</a>
								</div> <!--  dropdown-menu .// -->
							</div>  <!-- widget-header .// -->
						</div> <!-- widgets-wrap.// -->
					</div> <!-- col.// -->
				</div> <!-- row.// -->
				</div> <!-- container.// -->
			</section> <!-- header-main .// -->


			<nav class="navbar navbar-main navbar-expand-lg border-bottom">
			  <div class="container">
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav5" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="main_nav5">
			      <ul class="navbar-nav">
			        <li class="nav-item">
			          <a class="nav-link pl-0" href="#"> <strong>All category</strong></a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Fashion</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Supermarket</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Electronics</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Baby &amp; Toys</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Fitness sport</a>
			        </li>
			        <li class="nav-item dropdown">
			          <a class="nav-link dropdown-toggle" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
			          <div class="dropdown-menu">
			            <a class="dropdown-item" href="#">Foods and Drink</a>
			            <a class="dropdown-item" href="#">Home interior</a>
			            <div class="dropdown-divider"></div>
			            <a class="dropdown-item" href="#">Category 1</a>
			            <a class="dropdown-item" href="#">Category 2</a>
			            <a class="dropdown-item" href="#">Category 3</a>
			          </div>
			        </li>
			      </ul>
			    </div> <!-- collapse .// -->
			  </div> <!-- container .// -->
			</nav> <!-- navbar main end.// -->
		</header>
		<div class="container-fluid">
				<div class="row">
					<div class="col-sm">
	                    <?php include "./indexslide.php"; ?>
					</div>
				</div>
		</div>
		<div class="container">
			<br>
		
			<div class="row">
				<div class="col-sm">
					<div class="row">
                       <?php include "./indexproduct.php"; ?>
					</div>
				</div>
			</div>
		</div>
		<footer class="section-footer border-top">
			<div class="container">
				<section class="footer-top padding-y">
					<div class="row">
						<aside class="col-sm-6">
							<article class="mr-3">
								<figure id="logo" class="logo-footer"></figure>
								<!-- <img src="bootstrap-ecommerce-html/images/logo.png" class="logo-footer"> -->
								<p class="mt-3">Some short text about company like You might remember the Dell computer commercials in which a youth reports this exciting news to his friends.</p>
								<div>
								    <a class="btn btn-icon btn-light" title="Facebook" target="_blank" href="#"><i class="fa fa-facebook-f"></i></a>
								    <a class="btn btn-icon btn-light" title="Instagram" target="_blank" href="#"><i class="fa fa-instagram"></i></a>
								    <a class="btn btn-icon btn-light" title="Youtube" target="_blank" href="#"><i class="fa fa-youtube"></i></a>
								    <a class="btn btn-icon btn-light" title="Twitter" target="_blank" href="#"><i class="fa fa-twitter"></i></a>
								</div>
							</article>
						</aside>
						<aside class="col-sm-6">
							<h6 class="title">About</h6>
							<ul class="list-unstyled">
								<li> <a href="#">About us</a></li>
								<li> <a href="#">Services</a></li>
								<li> <a href="#">Rules and terms</a></li>
								<li> <a href="#">Blogs</a></li>
							</ul>
						</aside>
					</div> <!-- row.// -->
				</section>	<!-- footer-top.// -->

				<section class="footer-copyright border-top">
						<p target="_blank" class="float-right text-muted">
							<a href="#">Privacy &amp; Cookies</a> &nbsp;   &nbsp; 
							<a href="#">Accessibility</a>
						</p>
						<p class="text-muted"> © 2021 Company  All rights resetved </p>
						
				</section>
			</div><!-- //container -->
		</footer>


	</div>
	
	<?php include_once "./foot.php"; ?>
</body>
</html>