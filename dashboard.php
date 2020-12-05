<?php include_once "./head2.php"; ?>
<body>
	<div class="container-fluid">
		<?php include "./dashboardnav.php"; ?>
		<div class="row">
			<br>
			<div class="col-sm-3">
				<?php $active = "user";   include_once "./sidenav.php"; ?>
			</div>
			<div class="col-sm-9">
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
<!-- 	<script src="./node_modules/highcharts/highcharts.js"></script>
	<script src="./node_modules/highcharts/modules/exporting.js"></script>
	<script src="./node_modules/highcharts/modules/export-data.js"></script>
	<script src="./node_modules/highcharts/modules/accessibility.js"></script> -->
	<?php include_once "./foot.php"; ?>
		<script type="text/javascript">
    	(function($){
    		$(document).ready(function(){

    		});
    	})(jQuery);
    </script>
</body>
</html>