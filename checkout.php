    <?php 
  include_once "./model.php";
  $model = new Model();

    require "vendor/autoload.php";
    use Omnipay\Omnipay;
    $host = "localhost";
    $dbname = "emart";
    $username = "root";
    $password = "";
    $charset = "utf8";

    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password);
    ?>
    <?php
      if(!isset($_SESSION['cart'])){
        header("Location:login.php");
      }
      if(!isset($_SESSION['id'])){
        header("Location:login.php");
      }

                          // opd($_SESSION['cart']);

    ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>eMart</title>

  <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
  <meta name="description" content="ui library for front-end developers to create online shor templates">
  <meta name="keywords" content="ui kit, ecommerce templates, website, e-commerce, uikit framework, HTML, CSS, Bootstrap 4">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

  <!-- Bootstrap-ecommerce -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >

  <!-- <link rel="stylesheet" type="text/css" href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/bootstrap.css?v=2.0"> -->
  <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/ui.css?v=2.0" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.css" >
  <!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/responsive.css?v=2.0" rel="stylesheet"> -->

  <!-- fonticon -->
  <!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/fonts/fontawesome/css/all.min.css?v=2.0" type="text/css" rel="stylesheet"> -->

  <!-- Custom styling -->
  <link href="https://bootstrap-ecommerce.com/assets/css/style.css?v=2.0" rel="stylesheet">
      <!-- Animate Css -->
       
        <link rel="stylesheet" href="./index_files/style.css">
</head>
<body>
  <style type="text/css">
    .container-fluid {
      padding: 0;
      margin: 0 auto;
    }
    header {
      box-shadow: 1px 1px 10px #c9c9c9;
    }
    footer {
      background: white;
    }
  </style>
    <?php include_once "./headnew.php"; ?>
    <?php
      $profile = $model->getUserProfile();
    ?>
  <main class="container-fluid">
    <section class="container">
      <section class="sec0">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="tracking-wrap">
                        <div class="step active">
                            <span class="icon"> <i class="fa fa-cart-plus"></i> </span>
                            <span class="text">Add to Cart</span>
                        </div> <!-- step.// -->
                        <div class="step active">
                            <span class="icon"> <i class="fa fa-shopping-bag"></i> </span>
                            <span class="text">Proceed to Checkout</span>
                        </div> <!-- step.// -->
                        <div class="step active">
                            <span class="icon"> <i class="fa fa-credit-card"></i> </span>
                            <span class="text">Pay</span>
                        </div> <!-- step.// -->
                    </div>
                </div>
            </div>
        </div>
      <article class="row">
        <div class="col-sm">
          <br>
          <h4 class="mb-3">Billing address</h4>
            <input type="hidden" name="checkoutPay" value="true">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="firstName">Full name</label>
                <input type="text" data-target="#fullname2" class="copy form-control" id="firstName" placeholder="" value="<?= (isset($profile['fullname'])) ? $profile['fullname'] : ''; ?>" name="firstname" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="address">Delivery Address
              </label>
              <input type="text" data-target="#address2" class="copy form-control" id="address" placeholder="1234 Main St" value="<?= (isset($profile['address'])) ? $profile['address'] : ''; ?>" required name="address">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
            <div class="mb-3">
              <label for="address">Contact #</label>
              <input type="text" data-target="#contact2" class="copy form-control" id="contact" placeholder="Mobile #" required value="<?= (isset($profile['contact'])) ? $profile['contact'] : ''; ?>" name="contact">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" data-target="#email2" class="copy form-control" id="email" placeholder="you@example.com" value="<?= (isset($profile['email'])) ? $profile['email'] : ''; ?>" name="email">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>
        </div>
        <div class="col-sm">
          <style type="text/css">
            .card {
              cursor: pointer;
            }
            #card-errors {
              padding: 5px;
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
            .alert {
              margin-top: 20px;
              display: block;
            }
          </style>

          <br>
          <h4 class="mb-3">Payment Option</h4>
          <label for="cod">Cash On Delivery(COD)
          <input type="radio" id="cod" name="paymentType" checked value="cod"></label>
          <br>
          <label for="card">Credit/Debit Card
          <input type="radio" id="card" name="paymentType" value="Card">
        </label>
          <br>
          <br>
          <script src="https://js.stripe.com/v3/"></script>
          <form id="cod-form" method="post" action="ajax.php">
              <input type="hidden" name="amount" id="amount2" placeholder="Enter Amount" value="<?= $_SESSION['cart']['grandTotal'];?>" />
            <input type="hidden" name="codPayment" value="1">
            <div id="CardContainer" class="hidden">
                <input type="text" id="fullname2" value="<?= (isset($profile['fullname'])) ? $profile['fullname'] : ''; ?>" name="fullname" >
                <input type="text" id="address2"  value="<?= (isset($profile['address'])) ? $profile['address'] : ''; ?>"  name="address">
                <input type="text" id="contact2" value="<?= (isset($profile['contact'])) ? $profile['contact'] : ''; ?>" name="contact">
                <input type="email" id="email2" value="<?= (isset($profile['email'])) ? $profile['email'] : ''; ?>" name="email">

              </div>
            <input type="submit" class="btn btn-primary btn-lg" value="Submit Order">
          </form>
          <form action="" method="post" id="payment-form" class="hidden">
              <input type="text" name="amount" id="amount" placeholder="Enter Amount" value="<?= $_SESSION['cart']['grandTotal'];?>" />
              <div id="CardContainer" class="hidden">
                <input type="text" id="fullname2" value="<?= (isset($profile['fullname'])) ? $profile['fullname'] : ''; ?>" name="fullname" >
                <input type="text" id="address2"  value="<?= (isset($profile['address'])) ? $profile['address'] : ''; ?>"  name="address">
                <input type="text" id="contact2" value="<?= (isset($profile['contact'])) ? $profile['contact'] : ''; ?>" name="contact">
                <input type="email" id="email2" value="<?= (isset($profile['email'])) ? $profile['email'] : ''; ?>" name="email">

              </div>
              <div id="card-element">
              <!-- A Stripe Element will be inserted here. -->
              </div>
       
              <!-- Used to display form errors. -->
              <div id="card-errors" class="alert alert-danger" role="alert"></div>
            <button  id="submitpayment" class="btn btn-lg btn-primary">Submit Payment</button>
          </form>
        <?php                
          if (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) {
            

            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey('sk_test_51HsSJeJmfnsrzK571DnyysUarPcyEeRilLEVowF17n6MU5aJ5Vj9VBCaEEBm5bhuPPblYs2JjdAYanLq4iQI0dfz00VN23qHFc');

              try {
                  $token = $_POST['stripeToken'];
               
                  $response = $gateway->purchase([
                      'amount' => $_POST['amount'],
                      'currency' => 'PHP',
                      'token' => $token,
                  ])->send();
               
                  if ($response->isSuccessful()) {
                      // payment was successful: update database
                      $arr_payment_data = $response->getData();
                      $payment_id = $arr_payment_data['id'];
                      $amount = $_POST['amount'];
           
                      // Insert transaction data into the database
                      $isPaymentExist = $db->query("SELECT * FROM payments WHERE payment_id = '".$payment_id."'")->fetch();

                      if(!$isPaymentExist) { 
                          $sql = "INSERT INTO payments(payment_id, amount, currency, payment_status,userid) VALUES(?,?,?,?,?)
                          ";

                          $db->prepare($sql)->execute(array($payment_id, $amount, 'PHP', 'Captured', $_SESSION['id']));

                          //add transaction
                          $sql = "
                              INSERT INTO transaction(userid,total)
                              VALUES(?,?)
                          ";

                          $db->prepare($sql)->execute(array($_SESSION['id'], $_SESSION['cart']['total']));

                          $transactionId = $db->lastInsertId();

                          //add cart detail
                          $sql = "
                              INSERT INTO cart_details(transactionid,userid,fullname,address,contact,email,instruction,total,tax_total,grand_total,shipping_total)
                              VALUES(?,?,?,?,?,?,?,?,?,?,?)
                          ";

                          $db->prepare($sql)->execute(array($transactionId,$_SESSION['id'],$_POST['fullname'],$_POST['address'],$_POST['contact'],$_POST['email'],$_SESSION['cart']['instruction'],$_SESSION['cart']['total'],$_SESSION['cart']['taxTotal'],$_SESSION['cart']['grandTotal'],$_SESSION['cart']['shippingTotal']));
                          //add cart products
                          if(isset($_SESSION['cart']['products'])){
                            foreach($_SESSION['cart']['products'] as $idx0 => $i){
                              if(!empty($i)){
                                $f_pickup = $i['f_pickup'];
                                $f_shipping = $i['f_storeshipping'];
                                $f_total = $i['f_total'];
                                $f_tax = $i['f_tax'];

                                foreach($i['products'] as $idx => $p){
                                  $sql = "
                                      INSERT INTO cart(userid,productid,price,quantity,shipping,tax,transactionid,storeid,status, for_pickup)
                                      VALUES(?,?,?,?,?,?,?,?,?,?)   
                                  ";   

                                  $db->prepare($sql)->execute(array($_SESSION['id'],$p['detail']['activeproductid'],$p['detail']['price'],$p['qty'],$f_shipping,$p['detail']['tax'], $transactionId,$p['detail']['storeid'], 'pending', $f_pickup));

                                  if($p['detail']['active'] == "production"){
                                    $model->updateProductQuantityById($p['detail']['activeproductid'], $p['qty'], false, $p['productId']);
                                  } else {
                                    //productt
                                    $model->updateProductQuantityById($p['detail']['activeproductid'], $p['qty']);
                                  }

                                  //update remaining qty
                                  // $sql = "
                                  //   update productt
                                  //   set quantity = quantity-?
                                  //   where id = ?
                                  // ";

                                  // $db->prepare($sql)->execute(array($p['qty'], $p['detail']['activeproductid']));

                                  // if($p['detail']['active'] == "production"){
                                  //   $model->updateProductQuantityById($p['detail']['activeproductid'], $p['qty'], false, $p['productId']);
                                  // } else {
                                  //   //productt
                                  //    //product production
                                  //   $sql = "
                                  //     select t1.*
                                  //     from production t1
                                  //     where t1.remaining_qty > 0
                                  //     and t1.productid = ".$p['productId']." 
                                  //     and date(t1.expiry_date) > date(CURRENT_DATE) 
                                  //     and t1.deducted = 0
                                  //     order by t1.expiry_date asc
                                  //     limit 1
                                  //   ";

                                  //   $pRecord = $db->query($sql)->fetch();
                                  //   $productId = ($pRecord['id']) ? $pRecord['id'] : 0;
                                  //   $sql = "
                                  //     update production
                                  //     set remaining_qty = remaining_qty-?
                                  //     where id = ?
                                  //   ";
                                  //   $db->prepare($sql)->execute(array($p['qty'], $productId));
                                  // }
                              
                                  }
                              }
                            }
                          }
                      } 

                      $_SESSION['PENDINGREDIRECT'] = TRUE;
                      echo '<div class="alert alert-success" role="alert">
                          <h4 class="alert-heading">Well done!</h4>
                          <p>Payment was successful! You can check your order <a href="pending.php">here</a></p>
                          <hr>
                      </div>';
                      $_POST['REDIRECT'] = TRUE;
                  } else {
                      // payment failed: display message to customer
                      echo ' <br/><div class="alert alert-danger" role="alert">'.$response->getMessage().'</div>';
                  }
              } catch(Exception $e) {
                      echo ' <br/><div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
              }
          }
         ?>
        </div>
      </article>
    </section>
    <?php include "./newfooter.php"; ?>
    
  </main>
  <script src="./js/card.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
  <script type="text/javascript">
      (function($){
        $(document).ready(function(){
          $(".copy").on("keyup", function(){
            var me = $(this);

            $(me.data("target")).val(me.val());
          });

          $("input[name='paymentType']").on("click", function(){
            var me = $(this);

            console.log(me.val());
            if(me.val()=="Card"){
              $("#payment-form").removeClass("hidden");
              $("#cod-form").addClass("hidden");
            } else {
              $("#cod-form").removeClass("hidden");
              $("#payment-form").addClass("hidden");
            }
          });  
        });
    
      })(jQuery);
  </script>
</body>
</html>