<?php include "./head2.php";?>
<body>
    <?php include "./spinner.php"; ?>
	<div class="container">
		<div class="row">
			<br>
			<button id="t">test</button>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "order"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10" id="printContent">

				<div class="content">
					<div class=" row">
						<h4>Processed Orders</h4>		
						<?php
			              $order = $model->getPendingOrdersByStatus("processed");
			            ?>
					</div>
					<div class="row">
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
			                   h4 {
			                  	padding: 10px;
			                  }
			                </style>
			                <?php foreach($order as $idx => $i): ?>
			                  <?php foreach($i as $idx2 => $o): ?>
			                    <?php
			                      $cartItems = $model->getCartItemsByTransactionId($o['transactionid'], $o['storeid']);
			                      $preview = $model->getMediaById($o['productid']);
			                      $cartDetails = $model->getCartDetailByTransactionId($o['transactionid']);
			                      $user = $model->getUserInfoByUserid($o['userid']);
			                    ?>

			                    <tr>
			                      <td>
			                        <ul class="preview">
			                          <li>
			                            <img src="./uploads/merchant/<?= $o['storeid'];?>/<?= $o['productid']; ?>/<?= $preview['name']; ?>">
			                          </li>
			                      </td>
			                      <td>
			                      	<br>
			                      	<select data-storeid="<?= $o['storeid'];?>" data-date="<?= $o['date_created'];?>" class="status" data-id="<?= $o['id'];?>">
			                      		<option value="pending" <?= ($o['status'] == "pending") ? 'selected' : ''; ?>>Pending</option>
			                      		<option value="processed" <?= ($o['status'] == "processed") ? 'selected' : ''; ?>>Processed</option>
			                      		<option value="delivered" <?= ($o['status'] == "delivered") ? 'selected' : ''; ?>>Delivered</option>
			                      	</select>
		                      	</td>
			                      <td><?= $o['date_created'];?></td>
			                      <td>
			                        <a href="" class="btn btn-link view"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#eye-fill"/></svg></a>
			                        <a href="" class="btn btn-link print" data-store="<?= $_SESSION['storeName'];?>"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#printer-fill"/></svg> </a>
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
			                              <?php foreach($cartItems as $idx3 => $p): ?>
			                              <tr>
			                                <td><?= $p['productname'];?></td>
			                                <td>₱<?= $p['price'];?></td>
			                                <td><?= $p['quantity'];?></td>
			                                <td>₱<?= $p['shipping'];?> <?= ($p['for_pickup']) ? "<i>(For Pickup)</i>" : "";?></td>
			                                <td><?= $p['tax'];?>%</td>
			                              </tr>
			                              <?php endforeach ?>
		                            	  <tr>
			                              	<th colspan="5"><h5>Buyer's details</h5></th>
			                              </tr>
			                              <tr>
			                              	<td colspan="2"><b>Name:</b> <?= ($user) ? $user['fullname'] : '';?></td>
			                              	<td><b>Mobile:</b> <?= ($user) ? $user['contact'] : '';?></td>
			                              	<td><b>Address:</b> <?= ($user) ? $user['address'] : '';?></td>
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
	<?php include "./foot.php"; ?>
	<script type="text/javascript" src="./js/print.js"></script>
  	<script type="text/javascript">
    (function($){
    	$(".print").on("click", function(e){
    		e.preventDefault();

    		var me = $(this);
    		var target = me.parents("tr").next(".next");
    		target.print({
                //Use Global styles
                globalStyles : false,
                //Add link with attrbute media=print
                mediaPrint : false,
                //Custom stylesheet
                stylesheet : "./node_modules/bootstrap/dist/css/bootstrap.min.css",
                //Print in a hidden iframe
                // iframe : false,
                //Don't print this
                // noPrintSelector : ".avoid-this",
                //Add this at top
                prepend : me.data("store")+":",
                //Add this on bottom
                append : "Thank you for your purchase!",
                //Log to console when printing is done via a deffered callback
                deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
            });
    	});

    	$(".status").on("change", function(){
    		var me = $(this);

    		console.log(me.val(), me.data("id"));

    		showPreloader();
    		$.ajax({
    			url : "ajax.php",
    			data : { updateOrderStatus : true, id : me.data("id"),storeid : me.data("storeid"), date_added : me.data("date"), status : me.val()},
    			// data : { updateOrderStatus : true, id : me.data("id"), status : me.val()},
    			type : "post",
    			dataType : "json",
    			success : function(){
    				hidePreloader();
    			}
    		});
    	});

      $(".view").on("click", function(e){
        e.preventDefault();

        var me = $(this);

        me.parents("tr").next("tr").toggleClass("hidden");
      });
    })(jQuery);
  </script>
</body>
</html>