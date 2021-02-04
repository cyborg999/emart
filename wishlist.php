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
		header {
			box-shadow: 1px 1px 10px #c9c9c9;
		}
		footer {
			background: white;
		}
	</style>
	<div class="container-fluid">
   		 <?php include_once "headnew.php"; ?>
		
	
		<div class="container">
			<br>
		
			<div class="row">
				<div class="col-sm">
					<div class="row">
                       <article class="card">
							<header class="card-header"> My wishlist </header>
							<div class="card-body">

						<div class="row">
								<div class="col-md-4">
									<figure class="itemside mb-4">
										<div class="aside"><img src="bootstrap-ecommerce-html/images/items/1.jpg" class="border img-md"></div>
										<figcaption class="info">
											<a href="#" class="title">Some name of item goes here nice</a>
											<p class="price mb-2">$1280</p>
											<a href="#" class="btn btn-primary btn-sm"> Add to cart </a>
											<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="Remove from wishlist"> <i class="fa fa-times"></i> </a>
										</figcaption>
									</figure>
								</div> <!-- col.// -->

								<div class="col-md-4">
									<figure class="itemside mb-4">
										<div class="aside"><img src="bootstrap-ecommerce-html/images/items/2.jpg" class="border img-md"></div>
										<figcaption class="info">
											<a href="#" class="title">Great product name should be here</a>
											<p class="price mb-2">$1280</p>
											<a href="#" class="btn btn-primary btn-sm"> Add to cart </a>
											<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="Remove from wishlist"> <i class="fa fa-times"></i> </a>
										</figcaption>
									</figure>
								</div> <!-- col.// -->

								<div class="col-md-4">
									<figure class="itemside mb-4">
										<div class="aside"><img src="bootstrap-ecommerce-html/images/items/3.jpg" class="border img-md"></div>
										<figcaption class="info">
											<a href="#" class="title">Another name of item goes here </a>
											<p class="price mb-2">$1280</p>
											<a href="#" class="btn btn-primary btn-sm"> Add to cart </a>
											<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="Remove from wishlist"> <i class="fa fa-times"></i> </a>
										</figcaption>
									</figure>
								</div> <!-- col.// -->
							</div> <!-- row .//  -->

							</div> <!-- card-body.// -->
						</article>
					</div>
				</div>
			</div>
		</div>
		<footer class="section-footer border-top">
			<div class="container">
				<section class="footer-top padding-y">
					<div class="row">
						 <?php
					    	$setting = $model->getAdminSetting(true);
					    ?>
						<aside class="col-sm-6">
							<article class="mr-3">
								<figure id="logo" class="logo-footer"></figure>
            					<p class="mt-3"><?= ($setting) ? $setting['overview'] : ''; ?></p>
								<div>
									<?php
						              $social = $model->getAllSocialMedia();
						            ?>
							      <ul class="nav mr-auto d-none d-md-flex">
							      	<?php foreach($social as $idx => $s): ?>
								        <li><a href="<?= $s['link'];?>" class="nav-link px-2"> <i class="fa fa-<?= $s['social'];?>"></i> </a></li>
						              <?php endforeach ?>
							      </ul>

								</div>
							</article>
						</aside>
						<aside class="col-sm-3">
							<h4 style="padding:0;">Useful Links</h4>
				            <ul style="padding:0;">
				              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
				              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=about" target="_blank">About us</a></li>
				              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=terms" target="_blank">Terms of service</a></li>
				              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=privacy" target="_blank">Privacy policy</a></li>
				            </ul>
						</aside>
						<aside class="col-sm-3">
							<h4>Contact Us</h4>
            
            				<?= ($setting) ? $setting['contact'] : ''; ?>
            				<div class="text-md-left tesxt-muted">
										<i class="fa fa-lg fa-cc-visa"></i>
										<i class="fa fa-lg fa-cc-paypal"></i>
										<i class="fa fa-lg fa-cc-mastercard"></i>
									</div>
						</aside>
					</div> <!-- row.// -->
				</section>	<!-- footer-top.// -->
			</div><!-- //container -->
		</footer>


	</div>
	
	<?php include_once "./foot.php"; ?>
</body>
</html>