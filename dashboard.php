<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<a href="index.php"><figure class="logo"></figure></a>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "user"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<div class="jumbotron">
					<?php
						$pending = $model->checkIfPayed();
						$expiration = $model->getSubscriptionExpiration();  
					?>
				  	<?php if(!$_SESSION['verified']): ?>
					    <?php if(!$pending): ?>
					    	<p>Please verify your account <a href="activate.php">here</a> in order to list your product on our homepage</p>
					    <?php endif ?>
					<?php else: ?>
						<p><i>Your account is valid till <?= $expiration;?></i></p>
					<?php endif ?>			
					</div>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
</body>
</html>