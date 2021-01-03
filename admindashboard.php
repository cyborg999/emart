<?php include "./adminhead.php";?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<a href="./index.php"><figure class="logo"></figure></a>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="user"; include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<h3>Welcome back, <?= $_SESSION['username']; ?>!</h3>
					<?php
						$data = $model->loadAnnualUsersListener();

						// op($data['total']);
					?>

				</div>
				<div class="row content ">
					<div class="col-sm ">
						<canvas id="monthlyChart" width="100" height="40" aria-label="Hello ARIA World" role="img"></canvas>		
					</div>
				</div>


			</div>
		</div>
	</div>

	<?php include "./foot.php"; 

	?>
	<script src="./node_modules/chart.js/dist/Chart.min.js"></script>
	<script>
	    var options = {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }

		var d = new Date();
		var year = d.getFullYear();

		var annualData = {
		        labels: <?= json_encode($data['labels']);?>,
		        datasets: [{
		            label: 'Annual Number of Users',
		            data: <?= json_encode($data['total']);?>,
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