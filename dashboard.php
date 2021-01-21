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
				<?php $active = "dashboard"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="content row">
					<style type="text/css">
						.pending {
							text-align: center;
						}
					</style>
					<div class="col-sm">
						<h5>Dashboard</h5>
						<?php
							$annual = $model->getCurrentYearAnnualEarnings("ecom", false , false);

							// opd($annual);
							$pending = $model->checkIfPayed();
							$expiration = $model->getSubscriptionExpiration();  
						?>
					  	<?php if(!$_SESSION['verified']): ?>
						    <?php if(!$pending): ?>
						    	<p>Please verify your account <a href="activate.php">here</a> in order to list your product on our homepage</p>
						    <?php endif ?>
						<?php else: ?>
							<small><i>Your account is valid till <?= $expiration;?></i></small>
						<?php endif ?>
					</div>
					<div class="row">
						<?php
							$ecom = $model->getStoreMonthlyEarnings("ecom", true);
							$pos = $model->getStoreMonthlyEarnings("pos", true);
          					$pendingTotal = $model->getPendingOrdersByStatus("pending", true);
          					$processedTotal = $model->getPendingOrdersByStatus("processed", true);
          					if( ($processedTotal['total'] == 0) && ($pendingTotal['total'] == 0)){

          						$percent = 0;
          					} else {
          						$percent = ($processedTotal['total'] / ($processedTotal['total'] + $pendingTotal['total']) ) * 100;
          					}

						?>
							<div class="col-sm">
								<div class="card  text-white bg-primary  mb-3" style="max-width: 18rem;">
								  <div class="card-header">Earnings (Ecommerce)</div>
								  <div class="card-body">
								    <h5 class="card-title">₱ <?= number_format($ecom,2); ?></h5>
								  </div>
								</div>
							</div>
							<div class="col-sm">
								<div class="card bg-info text-white mb-3" style="max-width: 18rem;">
								  <div class="card-header">Earnings (POS)</div>
								  <div class="card-body">
								    <h5 class="card-title">₱ <?= number_format($pos,2); ?></h5>
								  </div>
								</div>
							</div>
							<div class="col-sm">
								<div class="card bg-light  mb-3" style="max-width: 18rem;">
								  <div class="card-header">Pending Orders</div>
								  <div class="card-body">
								    <h5 class="card-title pending"><?= $pendingTotal['total']; ?></h5>
								  </div>
								</div>
							</div>
							<div class="col-sm">
								<div class="card bg-light  mb-3" style="max-width: 18rem;">
								  <div class="card-header">Processed Orders (<?= $processedTotal['total']; ?>/<?= $processedTotal['total'] + $pendingTotal['total'];?>)</div>
								  <div class="card-body">
								  	<div class="progress">
									  <div class="progress-bar" role="progressbar" style="width: <?= $percent; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							</div>
						</div>
				</div>
				<div class="content">
					<div class="jumbotron">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
								  <h5 class="card-header">Ecommerce Annual Earnings </h5>
								  <div class="card-body">
									<canvas id="monthlyChart" width="100" height="100" aria-label="Hello ARIA World" role="img"></canvas>		
								  </div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
								  <h5 class="card-header">Monthly Earnings</h5>
								  <div class="card-body">
									<canvas id="myChart" width="100" height="100" aria-label="Hello ARIA World" role="img"></canvas>		
								  </div>
								</div>
							</div>
							
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
	<script src="./node_modules/chart.js/dist/Chart.min.js"></script>
	<script>
		var data = {
		        labels: ['POS', 'Ecommerce'],
		        datasets: [{
		            label: 'POS vs Ecommerce Sale',
		            data: [<?= $pos; ?>, <?= $ecom; ?>],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.5)',
		                'rgba(255, 159, 64, 0.5)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    };

		    var options = {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }

		var ctx = document.getElementById('myChart').getContext('2d');
		var myDoughnutChart = new Chart(ctx, {
		    type: 'doughnut',
		    data: data,
		    options: options
		});

		var d = new Date();
		var year = d.getFullYear();

		var annualData = {
		        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		        datasets: [{
		            label: 'Annual Sale ' + year,
		            data: <?= json_encode($annual['total']); ?>,
		            backgroundColor: [
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)',
		                'rgba(99, 161, 249, 0.5)'
		            ],
		            borderColor: [
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)',
		                'rgba(86, 150, 239, .8)'
		            ],
		            borderWidth: 1
		        }]
		    };
		var monthlyChart = document.getElementById('monthlyChart').getContext('2d');
		var myChart = new Chart(monthlyChart, {
		    type: 'bar',
		    data: annualData,
		    options: options
		});
		</script>
</body>
</html>