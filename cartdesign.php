<!DOCTYPE html>
<html>
    <?php include_once "./head.php"; ?>
<body>
    <?php include_once "./nav.php"; ?>
    <main>
    	<section class="sec1">
			<div class="px-4 px-lg-0">
				<style type="text/css">
					.sec1 {
					  background: #eee;
					  min-height: 100vh;
					  font-size: 18px;
					}
					.sec1 a {
						text-decoration: none;
					}
					.mb-4.font-italic {
						font-size: 16px;
					}
					b,strong {
						font-size: 16px;
					}
					.sec1 a {
						font-size: 26px;
					}
					tr td,
					th div {
						text-align: center;
					}
				</style>

			  <div class="pb-5">
			    <div class="container">
			      <div class="row">
			        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
			          <!-- Shopping cart table -->
			          <div class="table-responsive">
			            <table class="table">
			              <thead>
			                <tr>
			                  <th scope="col" class="border-0 bg-light">
			                    <div class="p-2 px-3 text-uppercase">Product</div>
			                  </th>
			                  <th scope="col" class="border-0 bg-light">
			                    <div class="py-2 text-uppercase">Price</div>
			                  </th>
			                  <th scope="col" class="border-0 bg-light">
			                    <div class="py-2 text-uppercase">Quantity</div>
			                  </th>
			                  <th scope="col" class="border-0 bg-light">
			                    <div class="py-2 text-uppercase">Shipping</div>
			                  </th>
			                   <th scope="col" class="border-0 bg-light">
			                    <div class="py-2 text-uppercase">Tax</div>
			                  </th>
			                  <th scope="col" class="border-0 bg-light">
			                    <div class="py-2 text-uppercase">Remove</div>
			                  </th>
			                </tr>
			              </thead>
			              <tbody>
			             
			              </tbody>
			            </table>
			          </div>
			          <!-- End -->
			        </div>
			      </div>

			      <div class="row py-5 p-4 bg-white rounded shadow-sm">
			        <div class="col-lg-6">
			          <!-- <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
			          <div class="p-4">
			            <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
			            <div class="input-group mb-4 border rounded-pill p-2">
			              <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
			              <div class="input-group-append border-0">
			                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
			              </div>
			            </div>
			          </div> -->
			          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
			          <div class="p-4">
			            <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
			            <textarea name="" id="instruction" cols="30" rows="2" class="form-control"></textarea>
			          </div>
			        </div>
			        <div class="col-lg-6">
			          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
			          <div class="p-4">
			            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
			            <ul class="list-unstyled mb-4">
			              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong id="total">0</strong></li>
			              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong id="shipping">0.00</strong></li>
			              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong id="tax">0.00</strong></li>
			              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
			                <h5 class="font-weight-bold" id="grandTotal">0.00</h5>
			              </li>
			            </ul><a href="#" id="checkout" class="btn btn-warning rounded-pill py-2 btn-block">Proceed to checkout</a>
			          </div>
			        </div>
			      </div>

			    </div>
			  </div>
			</div>
    	</section>
    </main>
  <script type="text/html" id="tpl">
    <tr>
      <th scope="row">
        <div class="p-2">
          <img src="./uploads/merchant/[STOREID]/[PRODUCTID]/[FILENAME]"" alt="" width="70" class="img-fluid rounded shadow-sm">
          <div class="ml-3 d-inline-block align-middle">
            <h5 class="mb-0"> <a href="./productdetail.php?id=[ID]"  target="_blank" class="text-dark d-inline-block">[NAME]</a></h5><span class="text-muted font-weight-normal font-italic">Category: [CATEGORY]</span>
          </div>
        </div>
        <td class="align-middle"><strong>₱[PRICE]</strong></td>
        <td class="align-middle"><strong>[QTY]</strong></td>
        <td class="align-middle"><strong>[SHIPPING]</strong></td>
        <td class="align-middle"><strong>[TAX]</strong></td>
        <td class="align-middle"><a href="#" data-id="[ID]" class="remove text-dark"><svg class="bi" width="25" height="25" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a>
        </td>
    </tr>
    </script>
    <script src="./js/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
        		var products = localStorage.getItem("items");

              var __listen = function(){
                $(".remove").off().on("click", function(e){
                  e.preventDefault();

                  var me = $(this);
                  var cartItems = JSON.parse(localStorage.getItem("items"));
                  var count = $("#count").html();

                  cartItems[me.data("id")] = null;

                  localStorage.setItem("items", JSON.stringify(cartItems));

                  $("#count").html(parseInt(count) - 1);

                  me.parents("tr").remove();
                });
              }

              __listen();


              function loadData() {
              	  $.ajax({
	                  url  : "ajax.php",
	                  data : { getCartItems : true, products :products},
	                  type : "post",
	                  dataType : "json",
	                  success : function(response){
	                  	lastProducts = response;

						var counter = 0;

	                    for(var i in response){
	                      var data = response[i];
	                      var detail = data.detail;
	                      var tpl = $("#tpl").html();
	                      var qty = data.qty.replace('"', '');
	                      qty = qty.replace('"', '');

		                   var tax = (detail.tax /100 ) * (detail.price * qty);
		                    total += qty * detail.price;
		                    shippingTotal += qty * detail.shipping;
		                    taxTotal += tax;

	                      tpl = tpl.replace("[STOREID]", detail.storeid).
	                        replace("[PRODUCTID]", data.productId).
	                        replace("[FILENAME]", detail.filename).
	                        replace("[NAME]", detail.name).
	                        replace("[PRICE]", detail.price).
	                        replace("[CATEGORY]", detail.category).
	                        replace("[SHIPPING]", "₱" + qty * detail.shipping + " <sup>(₱" + detail.shipping + ")</sup>").
	                        replace("[TAX]", "₱" + Math.round(tax) + " <sup>(" + (Math.round(detail.tax) + "%)</sup>")).
	                        replace("[QTY]", qty).
	                        replace("[ID]", detail.id).
	                        replace("[ID]", detail.id).
	                        replace("[ID]", detail.id);
	                       

	                        $("tbody").append(tpl);

	                        counter++;
	                        __listen();
	                    }

	                    $("#total").html("₱" + total);
	                    $("#shipping").html("₱" + shippingTotal);
	                    $("#tax").html("₱" + taxTotal);
	                    $("#grandTotal").html( "₱" + (total + shippingTotal + taxTotal));
	                    hidePreloader();
	                  }
	                });
              }

              //load cart items
	        	var id = [];
	        	var counter = 0;
				var lastProducts = null;
				var total = 0;
				var shippingTotal = 0;
				var taxTotal = 0;
				var grandTotal = 0;

              if(products != null){
                showPreloader();
              	
              	loadData();
              }

            $("#checkout").on("click", function(e){
              	e.preventDefault();

              	showPreloader();
              	$.ajax({
              		url  : "ajax.php",
              		data : { 
              			checkout : true , 
              			products : lastProducts ,
              			instruction : $("#instruction").val() ,
              			total : total ,
              			taxTotal : taxTotal ,
              			grandTotal : grandTotal ,
              			shippingTotal : shippingTotal 
              		},
              		type : "post",
              		dataType : "json",
              		success : function(response){
              			hidePreloader();
              		}
              	});
              });
              
            });
      
        })(jQuery);
    </script>
</body>
</html>