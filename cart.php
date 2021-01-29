
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
                    <a href="#" id="proceed" data-toggle="modal" data-target="#confirmationModal" class="btn btn-warning rounded-pill py-2 btn-block">Proceed to checkout</a>
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
            <div id="excluded"></div>
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

<style type="text/css">
  .location b,
  .location i,
  .location p {
    text-align: left;
    display: block;
  }
  .minimumTotal {
    font-weight: 700;
    display: block;
    line-height: 1;
  }
  .minimumTotal.active {

    color: red;
  }
  .tfoot td * {
    text-align: left;
  }
  tr.excludedTr {
    background: #ffefef;
  }
</style>
  <script type="text/html" id="tFoot">
    <tr class="tfoot">
      <td>
        <label class="[ALLOW_PICKUP]">Pick Up?
          <input type="checkbox" class="pickup" name="">
        </label>
      </td>
      <td colspan="3">
        <div class="location hidden">
          <b>Pick up location:</b>
          <i ><p class="pickuplocation">[PICKUP_LOCATION]</p></i>
        </div>
      </td>
      <td colspan="2">
        <b style="display: block;">Total : ₱ <span class="storeTotal" data-val="[STORETOTAL]">[STORETOTAL]</span></b>
        <small class="minimumTotal active">(Minimum Total ₱ <span class="minTotal">[MINTOTAL]</span>)</small>
        <b style="display: block;">Shipping : ₱ <span class="shipping" data-val="[SHIPPING]">[SHIPPING]</span></b>
      </td>
    </tr>
  </script>
  <script type="text/html" id="store">
  <tr class="storeTr" id="[ID]">
      <td colspan="6">
        <table class="table">
            <tr>
              <th colspan="1" scope="col" class="store align-middle border-0 bg-light">
                <h3>[STORE]</h3>
              </th>
              <th colspan="5" scope="col" class="store align-middle border-0 bg-light">
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
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 text-uppercase">Tax</div>
              </th>
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 text-uppercase">Remove</div>
              </th>
            </tr>
            [PRODUCTS]
        </table>
      </td>
  </tr>
  
  </script>
  <script type="text/html" id="tpl">
    <tr class="tr" data-shipping="[SHIPPING]" data-baseprice="[PRICE]" data-store="[STORENAME]">
      <td><img src="./uploads/merchant/[STOREID]/[PRODUCTID]/[FILENAME]"" alt="" width="70" class="img-fluid rounded shadow-sm"></td>
      <td><div class="ml-3 d-inline-block align-middle">
          <h5 class="mb-0" style="max-width: 100%;"><a href="./productdetail.php?id=[ID]"  target="_blank" class="text-dark d-inline-block">[NAME]</a></h5><span class="text-muted font-weight-normal font-italic">Category: [CATEGORY]</span>
        </div>
      </td>
        <td class="align-middle"><strong>₱ <span class="price" data-price="[PRICE]">[PRICE]</span></strong></td>
        <td class="align-middle">
          <nav aria-label="..." class="maxQty" data-id="[PRODUCTID]" data-max="100" class="qty">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a class="page-link count" data-action="minus" href="#">
                  <svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#dash"/></svg>
              </a></li>
              <li  class="page-item">
                <input type="number" min="1" width="80" class="manualInput form-control  qty" value="[QTY]" name="">
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

                $("#tbody .storeTr").each(function(x,y){
                  var me = $(this);
                  var tr = me.find(".tr");
                  var storeTrTotal = 0;
                  var storeTrTax = 0;

                  tr.each(function(){
                    var meTr = $(this);
                    var price = parseFloat(meTr.find(".price").data("price"));
                    var tax = parseFloat(meTr.find(".taxedPrice").data("tax"));
                    var shipping = parseFloat(meTr.data("shipping"));

                    storeTrTotal += price;
                    storeTrTax += tax;
                    subTotal += price;
                    shippingTotalInner += shipping;
                    taxTotalInner += tax;
                  });

                  var tFoot = me.find(".tfoot");

                  if(tFoot.html() != undefined){
                    var storeTotal = me.find(".storeTotal");

                    var sTotal = parseFloat(storeTrTotal) + parseFloat(storeTrTax);
                    var minTotal = tFoot.find(".minTotal");

                    if(parseFloat(sTotal) < parseFloat(minTotal.html())){
                      minTotal.addClass("active");
                    } else {
                      me.removeClass("excludedTr");
                    }

                    var minOrder = me.find(".minTotal");

                    if(sTotal >= parseFloat(minOrder.html())){
                      me.find(".minimumTotal").removeClass("active");
                      minTotal.removeClass("active");
                    } else {
                      me.addClass("excludedTr");
                      me.find(".minimumTotal").addClass("active");
                    }

                    storeTotal.html(sTotal);
                  }
               
                });

                if(!me.hasClass("excludedTr")){
                  console.log(me.attr("id"));
                  grandTotalInner = subTotal + shippingTotalInner + taxTotalInner;

                  total = subTotal;
                  taxTotal = taxTotalInner;
                  grandTotal = grandTotalInner;
                  shippingTotal = shippingTotalInner;

                  $("#total").html("₱"+subTotal.toLocaleString());
                  $("#shipping").html("₱"+shippingTotalInner.toLocaleString());
                  $("#tax").html("₱"+taxTotal.toLocaleString());
                  $("#grandTotal").html("₱"+grandTotalInner.toLocaleString());
                }
                
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

                        storeTpl = storeTpl.replace("[STORENAME]", store.storename).
                          replace("[ID]", store.productid).
                          replace("[LOGO]", store.storelogo);
                        tFoot = tFoot.replace("[SHIPPING]", store.storeshipping).
                          replace("[ALLOW_PICKUP]", (store.allow_pickup == 1) ? '' : 'hidden').
                          replace("[PICKUP_LOCATION]", store.pickup_location).
                          replace("[MINTOTAL]", store.minimum).
                          replace("[SHIPPING]", store.storeshipping);
                        orders = orders + storeTpl;
                        storeShipping += parseFloat(store.storeshipping);

                        var productsTpl = "";

                        for(var i in products){
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
                            replace("[STORENAME]", store.storename).
                            replace("[FILENAME]", detail.filename).
                            replace("[NAME]", detail.name).
                            replace("[PRICE]", detail.price).
                            replace("[SHIPPING]", detail.shipping).
                            replace("[SHIPPING]", detail.shipping).
                            replace("[PRICE]", detail.price * qty).
                            replace("[PRICE]", detail.price * qty).
                            replace("[CATEGORY]", detail.category).
                            // replace("[SHIPPING]", "₱" + qty * detail.shipping + " <sup>(₱" + detail.shipping + ")</sup>").
                            replace("[TAX]", "₱<span class='taxedPrice' data-tax='"+Math.round(tax) +"'>" + Math.round(tax) + "</span> <sup>(<span class='tax'>" + (Math.round(detail.tax) + "</span>%)</sup>")).
                            replace("[QTY]", qty).
                            replace("[ID]", detail.id).
                            replace("[ID]", detail.id).
                            replace("[ID]", detail.id);

                            orders = orders.replace("[STORE]", store.storename);
                            productsTpl = productsTpl + tpl;

                            counter++;
                        }
                        productsTpl = productsTpl + tFoot;
                        orders = orders.replace("[PRODUCTS]", productsTpl);
                        grandTotal = total + storeShipping + taxTotal;
                      }

                      $("#tbody").append(orders);
                      __listen();

                      shippingTotal = storeShipping;
                      
                      $("#total").html("₱" + total.toLocaleString());
                      $("#shipping").html("₱" + storeShipping.toLocaleString());
                      $("#tax").html("₱" + taxTotal.toLocaleString());
                      $("#grandTotal").html( "₱" + (grandTotal.toLocaleString()));

                      hidePreloader();
                      calculateFinalPrice();
                    }
                  });
              }

              var __listen = function(){
                $(".pickup").on("click", function(){
                  var me = $(this);
                  var selected = me.is(":checked");
                  var shipping = me.parents("tr").find(".shipping");

                  shipping.data("prevVal")
                  if(selected ===  true){
                    shipping.html(0.00);
                    me.parents("tr").prev("tr").data("shipping", 0);
                  
                  }  else {
                    shipping.html(shipping.data("val"));
                    me.parents("tr").prev("tr").data("shipping", shipping.data("val"));
                  }

                  calculateFinalPrice();

                  me.parents(".tfoot").find(".location").toggleClass("hidden");
                });

                $(".manualInput").off().on("keyup", function(e){
                    e.preventDefault();

                    var me = $(this);
                    var max = $(".maxQty").data("max");
                    var qty = me;
                    var current = parseInt(me.val());

                    var price = me.parents(".tr").find(".price");
                    var basePrice = me.parents(".tr").data("baseprice");
                    var taxedPrice = me.parents(".tr").find(".taxedPrice");
                    var tax = me.parents(".tr").find(".tax");
                    var qtyPrice = parseFloat(basePrice*current);
                        
                    price.html(qtyPrice);

                    var finalPrice = (parseFloat(tax.html()) /100 ) * (basePrice * current);

                    finalPrice = finalPrice.toLocaleString();

                    taxedPrice.html(finalPrice);

                    calculateFinalPrice();
                });

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

                    var price = me.parents(".tr").find(".price");
                    var basePrice = me.parents(".tr").data("baseprice");
                    var taxedPrice = me.parents(".tr").find(".taxedPrice");
                    var tax = me.parents(".tr").find(".tax");
                    var qtyPrice = parseFloat(basePrice*current);
                        
                    price.data("price", qtyPrice);
                    price.html(qtyPrice.toLocaleString());

                    var finalPrice = (parseFloat(tax.html()) /100 ) * (basePrice * current);

                    taxedPrice.data("tax", finalPrice);
                    finalPrice = finalPrice.toLocaleString();

                    taxedPrice.html(finalPrice.toLocaleString());

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

            function getValidProducts(products){
              var data = Array();
              var excludedItem = 0;

              $("#excluded").html("");

              $("#tbody .storeTr").each(function(x,y){
                var me = $(this);
                var minTotal = me.find(".minTotal");
                var itemName = me.find(".storeTotal");
                var productPerStore = me.find(".tr").length;
                var id = me.attr("id"); 
              console.log(productPerStore);

                if(minTotal.hasClass("active")){
                  excludedItem += productPerStore;
                } else {
                  data[id] = products[id];
                }
              });

              if(excludedItem > 0 ){
                $("#excluded").html("<b style='color:red;font-size:16px;'>("+ excludedItem +") items are excluded from your order because total amount is less than the required minimum total per store.</b><br/>");
              }

              console.log(excludedItem);
              return data;
            }

            $("#proceed").on("click", function(){
              getValidProducts(lastProducts);
            });

            $("#checkout").on("click", function(e){
                e.preventDefault();
                 var newData = getValidProducts(lastProducts);
                console.log(newData);

                if(newData.length < 1){
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