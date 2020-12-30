<?php include "./head2.php";?>
<body>
<?php include "./spinner.php";?>
	<div class="container">
		<div class="row" >
			<div class="col-sm-2">
				<a href="index.php"><figure class="logo"></figure></a>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<style type="text/css">
			#fs {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				/*min-height: 100vh;*/
				overflow: auto;
			}
			#fs .right {
				background: #eee;
			}
			.qty {
			    background: #042f6f;
			    color: white;
			    border-radius: 100%;
			    width: 20px;
			    height: 20px;
			    display: block;
			    text-align: center;
			    font-size: 10px;
			    line-height: 1.9;
			}
			.board {
				/*min-height: 70vh;*/
			}
			tr {
				background: white;
    			border-bottom: 1px solid #f1f1f1;
			}
			.board tr td {
				padding: 10px;
			}
			.table-result {
				position: relative;
				overflow: auto;
				max-height: 400px;
			}
		</style>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "pos"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10"  id="fs">
				<div class="content row board">
					<?php
						$fees = $model->getGlobalFees();
					?>
					<div class="col-sm-8 left">
						<div class="row">
							<div class="form-group">
								<input type="text" id="searchName" class="form-control" placeholder="search product..."/>
							</div>
						</div>
						<div class="row table-result">
							<br>
							<table class="table table-sm table-hover">
								 <thead>
					              <tr>
					                <th scope="col">Product</th>
					                <th scope="col">Name</th>
					                <th scope="col">Price</th>
					                <th scope="col">Brand</th>
					                <th scope="col">Quantity</th>
					                <th scope="col">Action</th>
					              </tr>
					            </thead>
								<tbody>
					              <tr id="search">

					              </tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-4 righttbl">
						<div class="table-responsive row">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Qty</th>
										<th>Name</th>
										<th>Each</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody id="tbody">
									
								</tbody>
							</table>
						</div>
						
						<style type="text/css">
							.righttbl {
								position: relative;
								height: 400px;
								overflow: auto;
								background: #eee;
							}
							.table-responsive {
								margin: 0 auto;
								box-sizing: border-box;
							}

						</style>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="row">
								<div class="grandtotal col-sm">

									<div class="row">
										<div class="col-sm-4">
											<a href="dashboard.php" class="float-left">< Back</a>
										</div>
										<div class="col-sm-8">
											<table class="table">
												<tbody>
													<tr>
														<th>Subtotal: </th>
														<td>P <span id="subTotal">0.00</span></td>
													</tr>
													<tr>
														<th>Tax: </th>
														<td><span id="tax"><?= ($fees) ? $fees['tax'] : "0";?></span>% (P<span id="insideTax">0.00</span>)</td>
													</tr>
												</tbody>
											</table>
											<div class="col-sm">
												<h5>Balance Due: P<span class="grandTotal">0.00</span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="col-sm-4">
							
							<div class="row">
								<div class="button">
									<a href="" id="pay" class="btn btn-primary btn-lg">Accept Payment P<span class="grandTotal">0.00</span></a>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		.name {
			max-width: 180px;
		}
		#tbody tr {
			cursor: pointer;
		}
	</style>
	<script type="text/html" id="itemTPL">
		<tr data-id="[PRODUCTID]">
			<td>
				<span class="qty">[QTY]</span>
			</td>
			<td>
				<p class="name">[NAME]</p>
			</td>
			<td>P <span class="perPrice">[PRICE]</span></td>
			<td><span class="price">P [TOTAL]</span></td>
		</tr>
	</script>

	<script type="text/html" id="productTPL">
      <tr class="result" id="edit[ID]">
         <td class="editphoto"><img height="50" width="auto" src="./uploads/merchant/[STOREID]/[PRODUCTID]/[FILENAME]" /></td>
          <td class="editname">[NAME]</td>
          <td class="editprice">[PRICE]</td>
          <td class="editbrand">[BRAND]</td>
          <td class="editqty"><input type="number" value="1" class="form-control quantity" name=""></td>
          <td>
            <a href="" data-qty="[QTY]"  data-expiry="[EXPIRY]" data-price="[SRP]" data-id="[ID]" data-name="[NAME]" class="btn btn-sm add"  ><svg class="bi" width="40" height="40" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#check"/></svg> </a>
          </td>
        </tr>
	</script>

	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			var products = Array();

			function getProducts(){
				products = Array();
				var globalTotal = 0;
				var insideTax = 0;
				var grandTotal = 0;
				var tax = $("#tax").html();

				$("#tbody tr").each(function(x, me){
					var tr = $(me);
					var data = Array();
					var productId = tr.data("id");
					var qty = parseInt(tr.find(".qty").html());
					var price = parseFloat(tr.find(".perPrice").html());
					var total = price* qty;

					globalTotal += total;

					insideTax = (globalTotal*(tax/100));
					grandTotal = insideTax+globalTotal;

					insideTax = financial(insideTax);
					grandTotal = financial(grandTotal);
					grandTotal = financial(grandTotal);

					products.push(Array(qty,price, productId));
				});

				$("#insideTax").html( insideTax);
				$("#subTotal").html( globalTotal);
				$(".grandTotal").html( grandTotal );

				__listen();
			}

			function financial(x) {
			  return Number.parseFloat(x).toFixed(2);
			}

			var __listen = function(){
				$("#tbody tr").off().on("click", function(e){
					e.preventDefault();

					var me = $(this);

					me.remove();
					getProducts();
				});

				$(".add").off().on("click", function(e){
					e.preventDefault();

					var me = $(this);
					var tr = me.parents(".result");
					var name = tr.find(".editname").html();
					var price = tr.find(".editprice").html();
					var qty = tr.find(".quantity").val();
					var productId = me.data("id");
					var trTpl = $("#itemTPL").html();

					trTpl = trTpl.replace("[QTY]", qty).
						replace("[PRODUCTID]", productId).
						replace("[NAME]", name).
						replace("[PRICE]", price).
						replace("[TOTAL]", price* parseInt(qty));

					$("#tbody").append(trTpl);

					getProducts();

				});
			}

			__listen();

			function reset(){
				$("#tbody tr").remove();
				$("#searchName").val("");
				$("#searchName").trigger("keyup");
				
				getProducts();
			}

			$("#pay").on("click", function(e){
				e.preventDefault();

				var tax = $("#tax").html();
				var total = $(".grandTotal").first().html();

				$.ajax({
					url : "ajax.php",
					data : { pay : true, grandTotal : total, tax : tax, products : products},
					type : "post",
					dataType : "json",
					success : function(response){
						reset();
					}
				});
			});

	        const debounce = (func, wait) => {
	          let timeout;

	          return function executedFunction(...args) {
	            const later = () => {
	              clearTimeout(timeout);
	              func(...args);
	            };

	            clearTimeout(timeout);
	            timeout = setTimeout(later, wait);
	          };
	        };

	        var returnedFunction = debounce(function() {
	          var txt = $("#searchName").val();

	          $(".result").remove();
	          
	          if(txt ==""){
	          	return;
	          }
	          showPreloader();

	           $.ajax({
	              url : "ajax.php"
	              , data : { searchMaterial : true, txt : txt }
	              , type : "post"
	              , dataType : "json"
	              , success : function(response){
	                // productTPL
	                // console.log(response);
	                for(var i in response){
	                  // console.log(response[i].name);
	                  var tpl = $("#productTPL").html();

	                  tpl = tpl.replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[NAME]", response[i].name).replace("[NAME]", response[i].name).replace("[STOREID]", response[i].storeid).replace("[PRODUCTID]", response[i].id).replace("[FILENAME]", response[i].filename)
	                  .replace("[PRICE]", response[i].price).replace("[PRICE]", response[i].price).replace("[BRAND]", response[i].brand).replace("[BRAND]", response[i].brand);

	                  $("#search").after(tpl);
	                }
	                
					__listen();
		            
		            hidePreloader();


	              }
	            });

	        }, 250);

	        window.addEventListener('resize', returnedFunction);

	        $('#searchName').on("keyup", returnedFunction);
		})(jQuery);
	</script>
</body>
</html>