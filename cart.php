
<!DOCTYPE html>
<html>
    <?php include_once "./head.php"; ?>
        <?php
      if(isset($_SESSION['usertype'])){
        if($_SESSION['usertype'] !="client"){
          header("Location:useronly.php");
        }
      }
    ?>
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
          .please {
            font-size: 16px;
          }
          .please a {
            font-size: 16px;
            color: #0072ff;
          }
        </style>

        <div class="pb-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                <!-- Shopping cart table -->
                <div class="table-responsive">
                  <table class="table">
                    <tbody id="tbody">
                   
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
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and Handling</strong><strong id="shipping">0.00</strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong id="tax">0.00</strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                      <h5 class="font-weight-bold" id="grandTotal">0.00</h5>
                    </li>
                  </ul>
                  <?php if(isset($_SESSION['id'])): ?>
                    <a href="#" data-toggle="modal" data-target="#confirmationModal" class="btn btn-warning rounded-pill py-2 btn-block">Proceed to checkout</a>
                  <?php else: ?>
                    <p class="please">Please <a href="./login.php">login</a> first to proceed to checkout.</p>
                  <?php endif ?>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      </section>
    </main>
    <style type="text/css">
      .logo {
        height: 30px;
        width: auto;
      }
      .store b {
        padding: 30px;
        display: block;
      }
      .qty {
        width: 50px;
        text-align: center;
        color: black;
        height: 30px;
      }
      .pagination-sm a.page-link {
        height: 31px;
      }
    </style>
  <script type="text/html" id="store">
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
   <tr>
        <th colspan="6" scope="col" class="store align-middle border-0 bg-light">
          <b>[STORE]</b>
        </th>
    
      </tr>
    
     <tr>
        <th scope="col" class="border-0 bg-light">
          <div class="p-2 px-3 text-uppercase">Product</div>
        </th>
        <th scope="col" class="border-0 bg-light">
          <div class="p-2 px-3 text-uppercase">Name</div>
        </th>
        <th scope="col" class="border-0 bg-light">
          <div class="py-2 text-uppercase">Price</div>
        </th>
        <th scope="col" class="border-0 bg-light">
          <div class="py-2 text-uppercase">Quantity</div>
        </th>
   <!--      <th scope="col" class="border-0 bg-light">
          <div class="py-2 text-uppercase">Shipping</div>
        </th> -->
         <th scope="col" class="border-0 bg-light">
          <div class="py-2 text-uppercase">Tax</div>
        </th>
        <th scope="col" class="border-0 bg-light">
          <div class="py-2 text-uppercase">Remove</div>
        </th>
      </tr>
  </script>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Proceed to checkout?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-sm">
            <h5>Are you sure you want to proceed to checkout?</h5>
            <br>
            <a href="" id="checkout" class="btn btn-lg btn-success">Proceed</a>
            <a href="" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <script type="text/html" id="tFoot">
    <tr>
      <td colspan="4">
      <td colspan="2">
        <b>Shipping : ₱ <span class="shipping">[SHIPPING]</span></b>
      </td>
    </tr>
  </script>
  <script type="text/html" id="tpl">
    [STORE]
    <tr class="tr" data-shipping="[SHIPPING]" data-baseprice="[PRICE]">
      <td><img src="./uploads/merchant/[STOREID]/[PRODUCTID]/[FILENAME]"" alt="" width="70" class="img-fluid rounded shadow-sm"></td>
      <td><div class="ml-3 d-inline-block align-middle">
          <h5 class="mb-0" style="max-width: 100%;"><a href="./productdetail.php?id=[ID]"  target="_blank" class="text-dark d-inline-block">[NAME]</a></h5><span class="text-muted font-weight-normal font-italic">Category: [CATEGORY]</span>
        </div>
      </td>
        <td class="align-middle"><strong>₱ <span class="price">[PRICE]</span></strong></td>
        <td class="align-middle">
          <nav aria-label="..." class="maxQty" data-id="[PRODUCTID]" data-max="100" class="qty">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a class="page-link count" data-action="minus" href="#">
                  <svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#dash"/></svg>
              </a></li>
              <li  class="page-item">
                <input type="number" class="form-control page-link qty" value="[QTY]" name="">
              </li>
              <li class="page-item"><a class="page-link count" data-action="plus" href="#">
                  <svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg>
              </a></li>
            </ul>
          </nav>
        </td>
        <!-- <td class="align-middle"><strong>[SHIPPING]</strong></td> -->
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
              var lastProducts = null;
              var total = 0;
              var shippingTotal = 0;
              var taxTotal = 0;
              var grandTotal = 0;
              var modifiedTotal = Array();

              function getQty(){
                var data = Array();

                $(".maxQty").each(function(){
                  var me = $(this);
                  var qty = parseInt(me.find(".qty").val());
                  var productId = me.data("id");

                  data[productId] = qty;
                });

                return data;
              }

              function calculateFinalPrice(){
                var subTotal = 0;
                var shippingTotalInner = 0;
                var taxTotalInner = 0;
                var grandTotalInner = 0;

                $("#tbody .tr").each(function(x,y){
                  var me = $(this);

                  var price = parseFloat(me.find(".price").html());
                  var tax = parseFloat(me.find(".taxedPrice").html());
                  var shipping = parseFloat(me.data("shipping"));

                  subTotal += price;
                  shippingTotalInner += shipping;
                  taxTotalInner += tax;
                });

                grandTotalInner = subTotal + shippingTotalInner + taxTotalInner;

                total = subTotal;
                taxTotal = taxTotalInner;
                grandTotal = grandTotalInner;
                shippingTotal = shippingTotalInner;

                $("#total").html("₱"+subTotal.toFixed(2));
                $("#shipping").html("₱"+shippingTotalInner.toFixed(2));
                $("#tax").html("₱"+taxTotal.toFixed(2));
                $("#grandTotal").html("₱"+grandTotalInner.toFixed(2));
              }

              function loadData() {
                  showPreloader();
                  $("tbody").html("");
                  
                  products = localStorage.getItem("items");
                  lastProducts = null;
                  total = 0;
                  shippingTotal = 0;
                  taxTotal = 0;
                  grandTotal = 0;

                  $.ajax({
                    url  : "ajax.php",
                    data : { getCartItems : true, products :products},
                    type : "post",
                    dataType : "json",
                    success : function(response){
                      var orders = "";
                      var storeShipping = 0;

                      lastProducts = response;

                      // console.log(response);
                      for(var r in response){
                        var store = response[r];
                        var products = store.products;
                        var storeTpl = $("#store").html();
                        var tFoot = $("#tFoot").html();
                        var counter = 0;

                        storeTpl = storeTpl.replace("[STORE]", store.storename).
                          replace("[LOGO]", store.storelogo);
                        tFoot = tFoot.replace("[SHIPPING]", store.storeshipping);

                        orders = orders + storeTpl;
                        storeShipping += parseFloat(store.storeshipping);

                        for(var i in products){
                          // console.log(products[i]);
                          var data = products[i];
                          var detail = data.detail;
                          var tpl = $("#tpl").html();
                          var qty = data.qty.replace('"', '');
                          qty = qty.replace('"', '');

                         var tax = (detail.tax /100 ) * (detail.price * qty);

                          if(detail.shipping == null){
                            detail.shipping = 0;
                          }
                          if(detail.shipping == ""){
                            detail.shipping = 0;
                          }

                          total += qty * detail.price;
                          taxTotal += tax;

                          tpl = tpl.replace("[STOREID]", detail.storeid).
                            replace("[PRODUCTID]", data.productId).
                            replace("[PRODUCTID]", data.productId).
                            replace("[FILENAME]", detail.filename).
                            replace("[NAME]", detail.name).
                            replace("[PRICE]", detail.price).
                            replace("[SHIPPING]", detail.shipping).
                            replace("[PRICE]", detail.price).
                            replace("[CATEGORY]", detail.category).
                            // replace("[SHIPPING]", "₱" + qty * detail.shipping + " <sup>(₱" + detail.shipping + ")</sup>").
                            replace("[TAX]", "₱<span class='taxedPrice'>" + Math.round(tax) + "</span> <sup>(<span class='tax'>" + (Math.round(detail.tax) + "</span>%)</sup>")).
                            replace("[QTY]", qty).
                            replace("[ID]", detail.id).
                            replace("[ID]", detail.id).
                            replace("[ID]", detail.id);

                            orders = orders + tpl;

                            counter++;
                        }
                        
                        orders = orders + tFoot;
                        grandTotal = total + storeShipping + taxTotal;
                      }

                      $("tbody").append(orders);
                      __listen();

                      shippingTotal = storeShipping;
                      
                      $("#total").html("₱" + total.toFixed(2));
                      $("#shipping").html("₱" + storeShipping.toFixed(2));
                      $("#tax").html("₱" + taxTotal.toFixed(2));
                      $("#grandTotal").html( "₱" + (grandTotal.toFixed(2)));

                      hidePreloader();
                    }
                  });
              }

              var __listen = function(){
                $(".count").off().on("click", function(e){
                    e.preventDefault();

                    var me = $(this);
                    var action = me.data("action");
                    var max = $(".maxQty").data("max");
                    var qty = me.parents(".pagination").find(".qty");
                    var current = parseInt(qty.val());

                    if(action == "plus"){
                        // if(parseInt(current) < max){
                          current +=1;
                          qty.val(current);
                        // }
                    } else {
                        if(parseInt(current) > 1){
                          current -=1;
                          qty.val(current);
                        }
                    }

                    var price = me.parents("tr").find(".price");
                    var basePrice = me.parents("tr").data("baseprice");
                    var taxedPrice = me.parents("tr").find(".taxedPrice");
                    var tax = me.parents("tr").find(".tax");
                    var qtyPrice = parseFloat(basePrice*current);
                        
                    price.html(qtyPrice);

                    var finalPrice = (parseFloat(tax.html()) /100 ) * (basePrice * current);

                    finalPrice = finalPrice.toFixed(2);

                    taxedPrice.html(finalPrice);

                    calculateFinalPrice();
                });

                $(".remove").off().on("click", function(e){
                  e.preventDefault();

                  var me = $(this);
                  var cartItems = JSON.parse(localStorage.getItem("items"));
                  var count = $("#count").html();

                  cartItems[me.data("id")] = null;

                  localStorage.setItem("items", JSON.stringify(cartItems));

                  $("#count").html(parseInt(count) - 1);

                  me.parents("tr").remove();

                  loadData();
                });
              }

              __listen();

              //load cart items
            if(products != null){
              loadData();
            }

            $("#checkout").on("click", function(e){
                e.preventDefault();

                if(lastProducts.length < 1){
                  alert("Please add an item first");
                  return false;
                }

                showPreloader();

                $.ajax({
                  url  : "ajax.php",
                  data : { 
                    checkout : true , 
                    modifiedQty : getQty(),
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

                    window.location.href = "checkout.php";
                  }
                });
              });
              
            });
      
        })(jQuery);
    </script>
</body>
</html>