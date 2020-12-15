<!DOCTYPE html>
<html>
    <?php include_once "./head.php"; ?>
<body>
    <?php include_once "./nav.php"; ?>
    <main>
        <section class="sec1">
          <article class="container">
          	<div class="row">
          		<div class="col-sm-8">
          			<style type="text/css">
          				thead {
          					background: #eee;
          				}
                  .product {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    width: 600px;
                  }
                  .product_left {
                    display: block;
                    width: 100px;
                  }
                  .product_right {
                    display: block;
                    width: 600px;
                  }
                  .product_img {
                    height: 100px;
                    width: auto;
                    margin: 0;
                  }
          			</style>
          			<table class="table table-sm table-hover">
          				<thead>
          					<tr>
          						<th>Products</th>
          						<th>
          							<a href="index.php">Continue Shopping</a>
          						</th>
          					</tr>
          				</thead>
          				<tbody>
          				
          			 </tbody>
          			</table>
          			
          		</div>
          		<div class="col-sm-4">
          			<h5>Purchase Summary</h5>
                <h1>Total : ₱<span id="total">0</span></h1>
                <br>
                <a href="" class="btn btn-lg btn-warning">Proceed to Checkout</a>
          		</div>
          	</div>
          </article>
        </section>
    </main>

    <script type="text/html" id="tpl">
      <tr>
        <td>
          <div class="product">
            <div class="product_left">
              <img src="./uploads/merchant/[STOREID]/[PRODUCTID]/[FILENAME]" class="product_img">
            </div>
            <div class="product_right">
              <a href="./productdetail.php?id=[ID]" target="_blank"><h4>[NAME]</h4></a>
              <h5 class="price">₱[PRICE]</h5>
              <b class="qty">[QTY]</b>
            </div>
          </div>     
        </td>
        <td>
          <a href="" data-id="[ID]" class="remove btn btn-sm btn-danger">remove</a>     
        </td>
      </tr>
    </script>
    <script src="./js/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
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

              //load cart items
            	var products = localStorage.getItem("items");
            	var id = [];
            	var counter = 0;
              console.log(products);

              if(products != null){
                showPreloader();
                $.ajax({
                  url  : "ajax.php",
                  data : { getCartItems : true, products :products},
                  type : "post",
                  dataType : "json",
                  success : function(response){
                    var total = 0;
                    var counter = 0;
                    for(var i in response){
                      var data = response[i];
                      var detail = data.detail;
                      var tpl = $("#tpl").html();
                      var qty = data.qty.replace('"', '');
                      qty = qty.replace('"', '');

                      tpl = tpl.replace("[STOREID]", detail.storeid).
                        replace("[PRODUCTID]", data.productId).
                        replace("[FILENAME]", detail.filename).
                        replace("[NAME]", detail.name).
                        replace("[PRICE]", detail.price).
                        replace("[QTY]", qty).
                        replace("[ID]", detail.id).
                        replace("[ID]", detail.id);

                        total += qty * detail.price;

                        $("tbody").append(tpl);

                        counter++;
                        __listen();
                    }

                    $("#total").html(total);
                    hidePreloader();
                  }
                });
              }
              
            });
      
        })(jQuery);
    </script>
</body>
</html>