<?php include "./head2.php";
  if(isset($_SESSION['PENDINGREDIRECT'])){

  }
?>
<body>
    <?php include "./spinner.php"; ?>
  <div class="container">
    <span id="cartClearer" data-clear="<?= (isset($_SESSION['PENDINGREDIRECT'])) ? true : false ;?>">
      <?php
        if(isset($_SESSION['PENDINGREDIRECT'])){
          unset($_SESSION['PENDINGREDIRECT']);

          if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
          }
        }
      ?>
    </span>
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
        <?php $active="order"; include "./usersidenav.php";?>
      </div>
      <div class="col-sm-10">

        <div class="content row">
          <div class="col-sm">
            <h3>Delivered Orders</h3>
            <?php
              $order = $model->getUserTransaction("delivered");

              // op($order);
            ?>
            <table class="table table-sm table-hover">
              <thead>
                <tr>
                  <th>Products</th>
                  <th>Status</th>
                  <th>Date Purchase</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <style type="text/css">
                  .preview {
                    list-style-type: none;
                    max-width: 200px;
                  }
                  .preview img {
                    height: 50px;
                    width: auto;
                    margin: 5px 0 0;
                  }
                  .preview li {
                    display: inline;
                    padding: 5px 0;
                  }
                  .next {
                  }
                </style>
                <?php foreach($order as $idx => $i): ?>
                  <?php foreach($i as $idx2 => $o): ?>
                    <?php
                      $cartItems = $model->getCartItemsByTransactionId($o['transactionid'], $o['storeid']);
                      $preview = $model->getMediaById($o['productid']);
                      $cartDetails = $model->getCartDetailByTransactionId($o['transactionid']);
                      $user = $model->getStoreOwnerDetailsById($o['storeid']);
                    ?>
                    <tr>
                      <td>
                        <ul class="preview">
                          <li>
                            <img src="./uploads/merchant/<?= $o['storeid'];?>/<?= $o['productid']; ?>/<?= $preview['name']; ?>">
                          </li>
                      </td>
                      <td class="status"><?= $o['status'];?></td>
                      <td><?= $o['date_created'];?></td>
                      <td>
                        <a href="" class="btn btn-primary view">view</a>
                        <a href="" data-id="<?= $o['id'];?>" class="btn btn-warning return" data-target="#editProductModal" data-toggle="modal">return</a>
                      </td>
                    </tr>
                  <!--   <tr>
                      <td colspan="6">
                        <?php
                          op($cartItems);
                        ?>
                      </td>
                    </tr> -->
                    <tr class="hidden next">
                      <td colspan="4">
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
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($cartItems as $idx3 => $p): ?>
                              <tr>
                                <td><?= $p['productname'];?></td>
                                <td>₱<?= $p['price'];?></td>
                                <td><?= $p['quantity'];?></td>
                                <td>₱<?= $p['shipping'];?></td>
                                <td>₱<?= $p['tax'];?></td>
                              </tr>
                         <!--      <tr>
                                <td colspan="5">
                                  <p>Total: <b>₱<?= $cartDetails['total'];?></b></p>
                                  <p>Tax Total: <b>₱<?= $cartDetails['tax_total'];?></b></p>
                                  <p>Shipping Total: <b>₱<?= $cartDetails['shipping_total'];?></b></p>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="5">
                                  <p>Grand Total: <b>₱<?= $cartDetails['grand_total'];?></b></p>
                                </td>
                              </tr> -->
                              <?php endforeach ?>
                              <tr>
                                <th colspan="5"><h5>Seller's details</h5></th>
                              </tr>
                              <tr>
                                <td><b>Store:</b> 
                                  <a target="_blank" href="shop.php?id=<?= $o['storeid'];?>"><?= ($user) ? $user['store'] : '';?></a>
                                </td>
                                <td>
                                  <img style="width: 50px;height: auto;" src="<?= ($user) ? $user['logo'] : '';?>">
                                </td>
                                <td><b>Mobile:</b> <?= ($user) ? $user['contact'] : '';?></td>
                                <td><b>Email:</b> <?= ($user) ? $user['email'] : '';?></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php endforeach ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="editProductModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Return Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row  ">
          <div class="col-sm msg hidden"></div>
        </div>
        <div class="row">

          <div class="col-sm">
            <h5>Reason:</h5>
            <textarea class="form-control" rows="3" id="reason" placeholder="Why do you want to cancel the order..."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="send">Send</button>
        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



  <?php include "./foot.php"; ?>
  <script type="text/javascript">
    (function($){
      function clearCart(){
        var cart = $("#cartClearer");

        if(cart.data("clear")){
          localStorage.clear();
        }
      }

      clearCart();

      $(".view").on("click", function(e){
        e.preventDefault();

        var me = $(this);

        me.parents("tr").next("tr").toggleClass("hidden");
      });

      var last = null;

       $(".return").on("click", function(e){
        e.preventDefault();

        var me = $(this);

        last = me;

        $("#send").data("id", me.data("id"));
      });

       $("#send").on("click", function(e){
        e.preventDefault();

        var me = $(this);
        var id = me.data("id");
        var reason = $("#reason").val();

        showPreloader();

        $.ajax({
          url : "ajax.php",
          data : { updateOrderStatus : true, id: id, status : "returned", reason : reason  },
          type : "post",
          dataType : "json",
          success : function(response){
            hidePreloader();
            last.parents("tr").find(".status").html("return requested");
            $("#close").trigger("click");
          }
        });
       });
    })(jQuery);
  </script>
</body>
</html>