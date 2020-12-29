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
				max-height: 500px;
			}
		</style>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "pos"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10"  id="fs">
				<div class="content row board">
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
						< back
					</div>
					<div class="col-sm-4">
							<div class="row">
								<div class="grandtotal col-sm">
									<div class="row">
										<div class="col-sm">
											<table class="table">
												<tbody>
													<tr>
														<th>Subtotal: </th>
														<td>P <span id="subTotal">0.00</span></td>
													</tr>
													<tr>
														<th>Tax: </th>
														<td>P <span id="tax">12</span>% (<span id="insideTax">0.00</span>)</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="col-sm">
											<h5>Balance Due: <br>P <span class="grandTotal">0.00</span></h5>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="button">
									<a href="" class="btn btn-primary btn-lg">Accept Payment P<span class="grandTotal">0.00</span></a>
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
	</style>
	<script type="text/html" id="itemTPL">
		<tr>
			<td>
				<span class="qty">[QTY]</span>
			</td>
			<td>
				<p class="name">[NAME]</p>
			</td>
			<td>P [PRICE]</td>
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
            <a href="" data-qty="[QTY]" data-expiry="[EXPIRY]" data-price="[SRP]" data-id="[ID]" data-name="[NAME]" class="btn btn-sm add"  ><svg class="bi" width="40" height="40" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#check"/></svg> </a>
          </td>
        </tr>
	</script>

	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			var globalTotal = 0;
			var tax = $("#tax").html();
			var __listen = function(){
				$(".add").off().on("click", function(e){
					e.preventDefault();

					var me = $(this);
					var tr = me.parents(".result");
					var name = tr.find(".editname").html();
					var price = tr.find(".editprice").html();
					var qty = tr.find(".quantity").val();
					var trTpl = $("#itemTPL").html();
					var total = price* parseInt(qty);

					trTpl = trTpl.replace("[QTY]", qty).
						replace("[NAME]", name).
						replace("[PRICE]", price).
						replace("[TOTAL]", price* parseInt(qty));

					globalTotal += total;

					var insideTax = (globalTotal*(tax/100));

					$("#tbody").append(trTpl);

					$("#insideTax").html( insideTax);
					$("#subTotal").html( globalTotal);
					$(".grandTotal").html( insideTax+globalTotal);
				});
			}

			__listen();

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