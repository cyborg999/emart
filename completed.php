<?php include "./userhead.php";
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
      <br>
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
                  .reviews {
                      display: flex;
                      flex-direction: column;
                      justify-content: space-around;
                  }
                  .box {
                       display: flex;
                      flex-direction: row;
                      justify-content: left;
                      margin: 10px 0;
                  }
                  .box_left {
                      display: block;
                      width: 100px;
                      height: 100px;
                  }
                  .box_right {
                      display: block;
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
                                <td>₱<?= number_format($p['price'],2);?></td>
                                <td><?= $p['quantity'];?></td>
                                <td>₱<?= number_format($p['shipping'],2);?></td>
                                <td><?= number_format($p['tax'],2);?>%</td>
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
                            <tfoot>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <th colspan="5">Review</th>
                              </tr>
                              <tr>
                                <td colspan="5">
                                    <style type="text/css">
                                        .review_rating,
                                        #rating {
                                            display: flex;
                                            flex-direction: row;
                                            justify-content: space-around;
                                            width: 150px;
                                        }
                                        .review_rating  figure.active,
                                        #rating figure.active {
                                            background: url(./node_modules/bootstrap-icons/icons/star-fill.svg);
                                            background-size: contain;
                                            background-repeat: no-repeat;
                                            width: 15px;
                                            height: 15px;
                                            margin: 0;
                                        }
                                        .review_rating  figure,
                                        #rating figure {
                                            background: url(./node_modules/bootstrap-icons/icons/star.svg);
                                            background-size: contain;
                                            background-repeat: no-repeat;
                                            width: 15px;
                                            margin: 0;
                                            height: 15px;
                                            display: block;
                                            cursor: pointer;
                                        }
                                    </style>
                                    <label>Rating</label>
                                     <div id="rating">
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                    </div>
                                    <br>
                                    <label>Comment</label>
                                    <textarea class="form-control textarea" id="comment" placeholder="type here..."></textarea>
                                    <br>
                                    <input data-id="<?= $o['productid'];?>" type="submit" id="addRating" class="btn  btn-primary" name="">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="5">
                                    <div class="reviews row">
                                      <span id="appendbefore"></span>
                                      <?php 
                                        $comments  = $model->getAllProductCommentsById($o['productid']);
                                      foreach($comments as $idx => $c): ?>
                                          <div class="box">
                                              <div class="box_left">
                                                  <img height="30" src="<?= ($c['profilePicture'] !='') ? $c['profilePicture'] : './node_modules/bootstrap-icons/icons/person-badge.svg';?>">
                                              </div>
                                              <div class="box_right">
                                                  <div class="review_rating">
                                                      <?php for($i = 1;$i<=5;$i++) : ?>
                                                          <?php if($i <= $c['rating']): ?>
                                                              <figure class="stars active"></figure>
                                                          <?php else : ?>
                                                              <figure class="stars"></figure>
                                                          <?php endif ?>
                                                      <?php endfor ?>
                                                      
                                                  </div>
                                                  <p><?= $c['comment'];?></p>
                                                  <i><?= $c['date_added'];?></i>
                                              </div>
                                          </div>
                                      <?php endforeach ?>
                                  </div>
                                </td>
                              </tr>
                            </tfoot>
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
          <form method="post"   enctype="multipart/form-data">
              <input type="hidden" name="returnItem" id="cartId" value="true">
          <div class="col-sm">
            <h5>Reason:</h5>
            <textarea class="form-control" rows="3" id="reason" name="reason" placeholder="Why do you want to cancel the order..."></textarea>
            <br>
            <h5>Upload Proof</h5>
            <input type="file" name="proof">
          </div>
            <br>
           <button type="submit" class="btn btn-primary" id="send">Send</button>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- start tpl -->
  <script type="text/html" id="tpl">
       <div class="box">
          <div class="box_left">
              <img height="30" src="[PROFILE]">
          </div>
          <div class="box_right">
              <div class="review_rating">
                  [RATING]
              </div>
              <p>[COMMENT]</p>
              <i>[DATE]</i>
          </div>
      </div>
  </script>
  <!-- end tpl -->

  <?php include "./foot.php"; ?>
  <script type="text/javascript">
    (function($){
       $("#rating figure").on("click", function(){
            var me = $(this);

            $("#rating .stars").removeClass("active");

            me.addClass("active");
            me.prevAll(".stars").addClass("active");

        });

        $("#addRating").on("click", function(e){
            e.preventDefault();

            var me = $(this);
            var rating = $("#rating .stars.active").length;
            var comment = $("#comment").val();

            if(comment != ""){
                showPreloader();

                $.ajax({
                    url  : "ajax.php",
                    data : { addRating : true, comment : comment, id : me.data("id"), rating : rating},
                    type : "post",
                    dataType : "json",
                    success : function(response){
                        hidePreloader();

                        var tplrating = $("#rating").html();
                        var tpl = $("#tpl").html();
                        var profile = response.profile;
                        tpl = tpl.replace("[COMMENT]", comment).
                            replace("[RATING]", tplrating).
                            replace("[PROFILE]", ( profile.profilePicture !=null) ? profile.profilePicture : './node_modules/bootstrap-icons/icons/person-badge.svg').
                            replace("[DATE]", "a few seconds ago");

                        $("#appendbefore").before(tpl);
                        $("#comment").val("");
                        $("#rating .stars.active").removeClass("active");
                    }
                });
            } else {
                alert("Please enter a comment");
            }
            console.log(comment, rating);
        }); 

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
        $("#reason").val("");
        $("#cartId").val(me.data("id"));
      });

       // $("#send").on("click", function(e){
       //  e.preventDefault();

       //  var me = $(this);
       //  var id = me.data("id");
       //  var reason = $("#reason").val();

       //  showPreloader();

       //  $.ajax({
       //    url : "ajax.php",
       //    data : { updateOrderStatus : true, id: id, status : "returned", reason : reason  },
       //    type : "post",
       //    dataType : "json",
       //    success : function(response){
       //      hidePreloader();
       //      window.location.href = "completed.php";
       //      // last.parents("tr").find(".status").html("return requested");
       //      // $("#close").trigger("click");
       //    }
       //  });
       // });
    })(jQuery);
  </script>
</body>
</html>