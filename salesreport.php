<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "reports"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="content row">
					<style type="text/css">
						.pending {
							text-align: center;
						}
					</style>
					<div class="col-sm">
						<h5>Sales Report</h5>
						<?php
							// $annual = $model->getCurrentYearAnnualEarnings();
						?>
					  	
					</div>
					<div class="row">
						<div class="col-sm-4">
							<b>Filter By:</b>
								<label>Month
									<input type="radio" class="filter" name="filter" value="months"/>
								</label>
								<label>Year
									<input type="radio" class="filter" name="filter" checked value="year"/>
								</label>
						</div>
						<div class="col-sm-5">
							<input type="text" id="year" class="form-control" placeholder="Year...">
							<select class="form-select hidden" id="months">
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
						</div>
						<div class="col-sm-3">
							<a href="" id="search" class="btn btn-sm btn-primary">filter</a>
						</div>
					</div>
				</div>
				<div class="content jumbotron">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Chart</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="false">Record</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<canvas id="monthlyChart" width="100" height="30" aria-label="Hello ARIA World" role="img"></canvas>		

							</div>
							<div class="tab-pane fade" id="chart" role="tabpanel" aria-labelledby="chart-tab">
								<br>
								<a href="ajax.php?salesreport=true">Export CSV</a>
								<div class="table-responsive">
									<table class="table table-sm table-hover">
										<thead>
											<tr>
												<th>Product</th>
												<th>Price</th>
												<th>Qty</th>
												<th>Shipping Fee</th>
												<th>Tax</th>
												<th>Date Purchased</th>
												<th>Date Delivered</th>
											</tr>
										</thead>
										<tbody id="tbody">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
				</div>


			</div>
		</div>
	</div>
	<script type="text/html" id="tpl">
		<tr>
			<td>[NAME]</td>
			<td>[PRICE]</td>
			<td>[QTY]</td>
			<td>[SHIP]</td>
			<td>[TAX]</td>
			<td>[PURCHASED]</td>
			<td>[DELIVERED]</td>
		</tr>
	</script>
	<?php include "./foot.php"; ?>
	<script src="./node_modules/chart.js/dist/Chart.min.js"></script>
	<script type="text/javascript">
		(function($){
			var lastData = null;
			var d = new Date();
			var year = d.getFullYear();
		    var options = {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }

		    var monthlyChart = document.getElementById('monthlyChart').getContext('2d');

		    function loadMonthly(month){
		    	$.ajax({
					url : "ajax.php",
					data : { loadMonthly : true, month : month},
					type : "post",
					dataType : "json",
					success : function(response){
						lastData = response.record;
						console.log(response.total );
						var annualData = {
					        labels: response.labels,
					        datasets: [{
					            label: 'Annual Sale ' + year,
					            data: response.total ,
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

						var myChart = new Chart(monthlyChart, {
						    type: 'bar',
						    data: annualData,
						    options: options
						});

						loadRecord();
					}
				});
		    }

			function loadChart(year){
				$.ajax({
					url : "ajax.php",
					data : { loadSalesReport : true, year : year},
					type : "post",
					dataType : "json",
					success : function(response){
						lastData = response.record;
						console.log(response.total );
						var annualData = {
					        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					        datasets: [{
					            label: 'Annual Sale ' + year,
					            data: response.total ,
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

						var myChart = new Chart(monthlyChart, {
						    type: 'bar',
						    data: annualData,
						    options: options
						});

						loadRecord();
					}
				});
			}

			function loadRecord(){
				$("#tbody tr").remove();

				for(var i in lastData){
					var d = lastData[i];
					var tpl = $("#tpl").html();

					tpl = tpl.replace("[NAME]", d.product).
						replace("[PRICE]", d.price).
						replace("[QTY]", d.quantity).
						replace("[SHIP]", d.shipping).
						replace("[TAX]", d.tax).
						replace("[PURCHASED]", d.date_created).
						replace("[DELIVERED]", d.delivery_date);


					$("#tbody").append(tpl);
				}
			}

			loadChart(year);


			$("#search").on("click", function(e){
				e.preventDefault();

				var filter = $(".filter:checked").val();

				if(filter == "year"){
					loadChart($("#year").val());
				} else {
					loadMonthly($("#months").val());
				}
			});

			$(".filter").on("change", function(){
				var me = $(this);

				console.log(me.val());

				if(me.val() == "months"){
					$("#months").removeClass("hidden");
					$("#year").addClass("hidden");
				} else {
					$("#months").addClass("hidden");
					$("#year").removeClass("hidden");
				}
			});
		})(jQuery);
	</script>

</body>
</html>