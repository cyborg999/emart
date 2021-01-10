<?php include "./head2.php";?>
<body>
<?php include "./spinner.php";?>
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
						<h5>Inventory Report</h5>
						
						<div class="row">
							<div class="col-sm-2">
								<b>Filter By:</b>
							</div>
							<div class="col-sm">
								<label>Name
									<input type="radio" class="filter" name="filter" checked value="name"/>
								</label>
								<label>Brand
									<input type="radio" class="filter" name="filter" value="brand"/>
								</label>
								<label>Category
									<input type="radio" class="filter" name="filter" value="category"/>
								</label>
								
								<label>Quantity
									<input type="radio" class="filter" name="filter" value="qty"/>
								</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm">
								<input type="text" id="txt" class="form-control" placeholder="Search...">
							</div>
							<div class="col-sm">
								<a href="" id="search" class="btn btn-primary btn-sm">Filter</a>
							</div>
						</div>
					</div>
				</div>
				<div class="content jumbotron">
					<div class="row">
						<div class="col-sm">
							<a href="ajax.php?export=true&inventory=1">Export CSV</a>
							<br>
							<br>
							<div class="table-responsive">
								<table class="table table-sm table-hover">
									<thead>
										<tr>
											<th>Product</th>
											<th>Price</th>
											<th>Qty</th>
											<th>Brand</th>
											<th>Category</th>
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
			<td>[BRAND]</td>
			<td>[CATEGORY]</td>
		</tr>
	</script>
	<?php include "./foot.php"; ?>
	<script src="./node_modules/chart.js/dist/Chart.min.js"></script>
	<script type="text/javascript">
		(function($){
			var lastData = null;
			var d = new Date();

		    function loadData(){
		    	showPreloader();
		    	$.ajax({
					url : "ajax.php",
					data : { loadInventory : true, filter: $(".filter:checked").val(), txt : $("#txt").val() },
					type : "post",
					dataType : "json",
					success : function(response){
						lastData = response.record;
						
						loadRecord();
						hidePreloader();
					}
				});
		    }

			function loadRecord(){
				$("#tbody tr").remove();

				for(var i in lastData){
					var d = lastData[i];
					var tpl = $("#tpl").html();

					tpl = tpl.replace("[NAME]", d.name).
						replace("[PRICE]", d.price).
						replace("[QTY]", d.quantity).
						replace("[BRAND]", d.brand).
						replace("[CATEGORY]", d.category);


					$("#tbody").append(tpl);
				}
			}

			loadData();

			$("#search").on("click", function(e){
				e.preventDefault();

				var filter = $(".filter:checked").val();

				loadData();
			});
		})(jQuery);
	</script>

</body>
</html>