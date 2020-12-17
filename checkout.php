<!DOCTYPE html>
<html>
    <?php include_once "./head.php"; ?>
<body>
    <?php include_once "./nav.php"; ?>
    <main>
    	<section class="sec1">
    		<article class="container">
    			<div class="row">
    				<div class="col-sm">
    					<?php
    						// op($_SESSION['cart']);

    					?>
          <form action="charge.php" method="post" id="payment-form">
          <!-- <form class="needs-validation" method="post"> -->
    					<div class="row">
                <div class="col-md-5 order-md-2 mb-4">
                <br>
                 <h4 class="mb-3">Payment</h4>
                    <div class="row">
                      <style type="text/css">
                        .card {
                          cursor: pointer;
                        }
                        iframe#stripe {
                          width: 100%;
                          height: 100vh;
                        }
                        #card-errors {
                          margin-top: 10px;
                          padding: 0;
                        }
                        button {
                          background: #007bff;
                          color: white;
                          padding: 10px;
                          border-radius: 5px;
                          border: 0;
                          font-weight: 700;
                          margin-top: 10px;
                        }
                        .StripeElement {
                            box-sizing: border-box;
                           
                            height: 40px;
                           
                            padding: 10px 12px;
                           
                            border: 1px solid transparent;
                            border-radius: 4px;
                            background-color: white;
                           
                            box-shadow: 0 1px 3px 0 #e6ebf1;
                            -webkit-transition: box-shadow 150ms ease;
                            transition: box-shadow 150ms ease;
                        }
                         
                        .StripeElement--focus {
                            box-shadow: 0 1px 3px 0 #cfd7df;
                        }
                         
                        .StripeElement--invalid {
                            border-color: #fa755a;
                        }
                         
                        .StripeElement--webkit-autofill {
                            background-color: #fefde5 !important;
                        }
                        #amount {
                          display: none;
                        }
                        .StripeElement,
                        #payment-form {
                          width: 100%;
                        }
                      </style>
                      <script src="https://js.stripe.com/v3/"></script>
                      <!-- <form action="charge.php" method="post" id="payment-form"> -->
                          <div class="form-row">
                              <input type="text" name="amount" id="amount" placeholder="Enter Amount" value="<?= $_SESSION['cart']['grandTotal'];?>" />
                              <label for="card-element">Credit/Debit Card</label>
                              <div id="card-element">
                              <!-- A Stripe Element will be inserted here. -->
                              </div>
                       
                              <!-- Used to display form errors. -->
                              <div id="card-errors" class="alert alert-danger" role="alert"></div>
                          </div>
                          <button  id="submitpayment">Submit Payment</button>
                      <!-- </form> -->
                    </div>
                  </div>
                  <div class="col-md-7 order-md-1">
                    <br>
                    <h4 class="mb-3">Billing address</h4>
                      <input type="hidden" name="checkoutPay" value="true">
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="firstName">First name</label>
                          <input type="text" class="form-control" id="firstName" placeholder="" value="" name="firstname" required>
                          <div class="invalid-feedback">
                            Valid first name is required.
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="lastName">Last name</label>
                          <input type="text" class="form-control" id="lastName" placeholder="" name="lastname"  value="" required>
                          <div class="invalid-feedback">
                            Valid last name is required.
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="address">Delivery Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required name="address">
                        <div class="invalid-feedback">
                          Please enter your shipping address.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="address">Contact #</label>
                        <input type="text" class="form-control" id="contact" placeholder="Mobile #" required name="contact">
                        <div class="invalid-feedback">
                          Please enter your shipping address.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email">
                        <div class="invalid-feedback">
                          Please enter a valid email address for shipping updates.
                        </div>
                      </div>

                      
                  </div>
                </div>
              </form>
    				</div>
    			</div>
    		</article>
    	</section>
    </main>
  <script src="./js/card.js"></script>
  <script type="text/html" id="tpl">

    </script>
    <script src="./js/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
           
           });
      
        })(jQuery);
    </script>
</body>
</html>