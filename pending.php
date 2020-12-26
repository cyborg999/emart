<?php include "./head2.php";?>
<body>
  <div class="container">
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
            <h3>Pending Orders</h3>
            <?php
              $order = $model->getUserTransaction("pending");
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
                <?php foreach($order as $idx => $o): ?>
                  <?php
                    $products = $model->getCartByTransactionId($o['id']);
                    $cartItems = $model->getCartItemsByTransactionId($o['id']);
                    $preview = $model->getMediaById($o['id']);
                    $cartDetails = $model->getCartDetailByTransactionId($o['id']);
                    // op($preview);

                  ?>
                  <tr>
                    <td>
                      
                      <ul class="preview">
                        <li>
                          <img src="./uploads/merchant/<?= $preview['storeid'];?>/<?= $preview['productid']; ?>/<?= $preview['name']; ?>">
                        </li>
                    </td>
                    <td><?= $o['status'];?></td>
                    <td><?= $o['date_created'];?></td>
                    <td>
                      <a href="" class="btn btn-primary view">view</a>
                    </td>
                  </tr>
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
                            <?php foreach($cartItems as $idx => $p): ?>
                            <tr>
                              <td><?= $p['productname'];?></td>
                              <td>₱<?= $p['price'];?></td>
                              <td><?= $p['quantity'];?></td>
                              <td>₱<?= $p['shipping'];?></td>
                              <td>₱<?= $p['tax'];?></td>
                            </tr>
                            <tr>
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
                            </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                    
                    </td>
                  </tr>
                <?php endforeach ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include "./foot.php"; ?>
  <script type="text/javascript">
    (function($){
      $(".view").on("click", function(e){
        e.preventDefault();

        var me = $(this);

        me.parents("tr").next("tr").toggleClass("hidden");
      });
    })(jQuery);
  </script>
</body>
</html>