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
				<?php $active = "user"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<div class="jumbotron">
						<div class="row">
							<div class="col-sm">
								<figure class="highcharts-figure">
								    <div id="container"></div>
								</figure>
							</div>
							<div class="col-sm">
								<figure class="highcharts-figure">
								    <div id="line"></div>
								</figure>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
</body>
</html>