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
						<h5>Analytics</h5>
					</div>
					
				</div>
				<!-- <div class="row content">
						<div class="col-sm-4">
							<b class="label">Filter By:</b>
							<label> Date Range
								<input type="radio" class="filter" name="filter" value="daterange">
							</label>
							<label>Month
								<input type="radio" class="filter" name="filter" value="months"/>
							</label>
							<label>Year
								<input type="radio" class="filter" name="filter" checked value="year"/>
							</label>
						</div>
						<div class="col-sm-7">
							<input type="text" id="year" class="form-control" placeholder="Year...">
							<select class="form-select hidden form-control" id="months">
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
							<div class="row hidden" id="twodates">
								<div class="col-sm-6">
									<label>Date Start:</label>
									<input type="date" id="datestart" class="form-control" placeholder="Enter date">
								</div>
								<div class="col-sm-6">
									<label>Date End:</label>
									<input type="date" id="dateend" class="form-control" placeholder="Enter date">
								</div>
								
							</div>
						</div>
						<div class="col-sm-1">
							<a href="" id="search" class="btn btn-sm btn-primary">filter</a>
						</div>
					</div> -->
				<div class="content jumbotron">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Municipality</a>
						  </li>
						 <!--  <li class="nav-item">
						    <a class="nav-link" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="false">Customer Age</a>
						  </li> -->
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<canvas id="monthlyChart" width="100" height="30" aria-label="Hello ARIA World" role="img"></canvas>		

							</div>
							<div class="tab-pane fade shsow activse" id="chart" role="tabpanel" aria-labelledby="chart-tab">
								<br>
								<canvas id="ageChart" width="100" height="30" aria-label="Hello ARIA World" role="img"></canvas>		
								
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

		    function loadDateRange(date1, date2){
		    	$.ajax({
					url : "ajax.php",
					data : { loadDateRange : true, date2 : date1, date3:date2},
					type : "post",
					dataType : "json",
					success : function(response){
						lastData = response.record;
						console.log(response.total );
						var annualData = {
					        labels: response.labels,
					        datasets: [{
					            label: 'Date Range from ' + date1 + ' to ' + date2,
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
					data : { loadAnnualCustomerByMunicipality : true, year : year},
					type : "post",
					dataType : "json",
					success : function(response){
						lastData = response.record;
						console.log(response.total );
						var annualData = {
					        labels: ['Boac', 'Mogpog', 'Santa Cruz', 'Torrijos', 'Buenavista', 'Gasan'],
					        datasets: [{
					            label: 'Customers by Municipality for year '+ year,
					            data: response.total ,
					            backgroundColor: [
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


			function loadAge(year){
				$.ajax({
					url : "ajax.php",
					data : { loadAnnualCustomerByMunicipality : true, year : year},
					type : "post",
					dataType : "json",
					success : function(response){
						lastData = response.record;
						console.log(response.total );
						var annualData = {
					        labels: ['Boac', 'Mogpog', 'Santa Cruz', 'Torrijos', 'Buenavista', 'Gasan'],
					        datasets: [{
					            label: 'Customers by Municipality for year '+ year,
					            data: response.total ,
					            backgroundColor: [
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
			// loadAge(year);


			$("#search").on("click", function(e){
				e.preventDefault();

				var filter = $(".filter:checked").val();

				if(filter == "year"){
					loadChart($("#year").val());
				} else if(filter == "months") {
					loadMonthly($("#months").val());
				} else {
					var dateStart = $("#datestart").val();
    				var dateEnd = $("#dateend").val();

					loadDateRange(dateStart, dateEnd);
				}
			});

			$(".filter").on("change", function(){
				var me = $(this);

				console.log(me.val());

				if(me.val() == "months"){
					$("#months").removeClass("hidden");
					$("#year").addClass("hidden");
					$("#twodates").addClass("hidden");
				} else if (me.val() == "year"){
					$("#months").addClass("hidden");
					$("#year").removeClass("hidden");
					$("#twodates").addClass("hidden");
				} else {
					$("#months").addClass("hidden");
					$("#year").addClass("hidden");
					$("#twodates").removeClass("hidden");
				}
			});
		})(jQuery);
	</script>

</body>
</html>