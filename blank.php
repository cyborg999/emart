<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<figure class="logo"></figure>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<h3>Welcome back, Linda!</h3>
					<p>You have 24 new messages and 5 new notifications.</p>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
</body>
</html>