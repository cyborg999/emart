<?php 
    include_once "./model.php";

    $model = new Model();
    $err = $model->getErrors();
  $logo = $model->getLogo();
 require_once "vendor/autoload.php";
use Omnipay\Omnipay;
// $check = $model->preventReaccessIfPayed();
$host = "localhost";
$dbname = "emart";
$username = "root";
$password = "";
$charset = "utf8";

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password); 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="./node_modules/chart.js/dist/Chart.min.css">



    <link rel="stylesheet" href="./node_modules/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="./node_modules/chosen-js/chosen.min.css" >
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.css" >
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <script src="./node_modules/dropzone/dist/min/dropzone.min.js"></script>
    <title>eMart</title>
  </head>
<body>

  <style type="text/css">
/*@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");*/
/*@import url("./css/fa.css");*/

.navbar-icon-top .navbar-nav .nav-link > .fa {
position: relative;
width: 36px;
font-size: 24px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
font-size: 0.75rem;
position: absolute;
right: 0;
font-family: sans-serif;
}

.navbar-icon-top .navbar-nav .nav-link > .fa {
top: 3px;
line-height: 12px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
top: -10px;
}

@media (min-width: 576px) {
.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 768px) {
.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 992px) {
.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 1200px) {
.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

    </style>

<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">eMart</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse contsainer" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
     
    </ul>
    <ul class="navbar-nav " style="padding-right:60px;">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fa fa-home"></i>
          <span class="sr-only">(current)</span>
          </a>
      </li>
    <!--   <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fa fa-envelope-o">
            <span class="badge badge-danger">11</span>
          </i>
        </a>
      </li> -->
      <?php
        $review = $model->getNotificationsByType("UserReview");
        $order = $model->getNotificationsByType("Order");
      ?>
      <li class="nav-item">
        <a class="nav-link" href="notifications.php?type=order">
          <i class="fa fa-bell">
            <span class="badge badge-info"><?= count($order);?></span>
          </i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="notifications.php?type=UserReview">
          <i class="fa fa-globe">
            <span class="badge badge-success"><?= count($review);?></span>
          </i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-gears">
          </i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile.php">Profile</a>
          <a class="dropdown-item" href="store.php">Store</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      <li class="nav-item dropdown"></li>
    </ul>
  </div>
</nav>
<style type="text/css">
  .navbar-expand-lg .navbar-nav .dropdown-menu {
    left: initial;
    right: 20px!important;
  }
</style>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="user"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="content">
					<?php  include_once "./error.php"; ?>
					<br>
				<h3>Activate your account</h3>
				<div class="row ">
					<?php 					
					$store = $model->getUserStore();
					$amount = $store['cost'] * $store['duration'];
					$subscription = $model->getActiveSubscriptions();
					$codSubscription = $model->getCODSubscription();

					foreach($subscription as $idx => $sub): ?>
						<div class="col-sm-4 cardd">
							<div class="card mb-3 <?= ($sub['id'] == $store['subscriptionid']) ? 'border-success' : '';?>"  data-id="<?= $sub['id'];?>" data-price="<?= $sub['cost'] * $sub['duration'];?>" style="max-width: 18rem;">
							  <div class="card-header"><?= $sub['title'];?></div>
							  <div class="card-body <?= ($sub['id'] == $store['subscriptionid']) ? 'text-success' : '';?>">
							    <h5 class="card-title"><?= $sub['caption'];?></h5>
							    <p class="card-text"><?= $sub['cost'];?>/<small>Month</small></p>
							  </div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
				<div class="row">
					<div class="col-sm">
						<hr>
						<b>Payment Type:</b>
						<label>Card
							<input type="radio" checked class="type" name="type" value="card">
						</label>
						<label>Cash
							<input type="radio" class="type"  name="type"  value="cash">
						</label>
					</div>
				</div>
				<hr>
				<div class="row hidden" id="cash">
					<div class="col-sm">
						<h2>Cash</h2>
						<form method="post">
							<label>Payment Date:</label>
							<input type="hidden" name="codSubscription" value="true">
							<input type="hidden" name="amount" id="amount2" value="<?= $amount;?>">
							<input type="date" required class="form-control" value="<?= ($codSubscription) ? $codSubscription['codsub_date'] : '';?>" name="date">
							<br>
							<input type="submit" class="btn btn-primary" value="Send" name="">
						</form>
					</div>
				</div>
				<div class="row " id="card">
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
						.alert {
							margin-top: 20px;
							display: block;
						}
					</style>
					<script src="https://js.stripe.com/v3/"></script>
					<div class="col-sm">
						<h2>Card</h2>
						<form action="" method="post" id="payment-form">
						    <div class="form-row">
						        <input type="hidden" name="subscriptionid" id="subscriptionid" value="<?= $store['subscriptionid'];?>" />
						        <input type="text" name="amount" id="amount" placeholder="Enter Amount" value="<?= $amount;?>" />
						        <label for="card-element">Credit/Debit Card</label>
						        <div id="card-element">
						        <!-- A Stripe Element will be inserted here. -->
						        </div>
						 
						        <!-- Used to display form errors. -->
						        <div id="card-errors" class="alert alert-danger" role="alert"></div>
						    </div>
						    <button  id="submitpayment">Submit Payment</button>
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
							                $sql = "INSERT INTO payments(payment_id, amount, currency, payment_status,userid,payment_for) VALUES(?,?,?,?,?,?)
							                ";

							                $db->prepare($sql)->execute(array($payment_id, $amount, 'PHP', 'Captured', $_SESSION['id'], "subscription"));

							                //update storeid
							                $sql = "
							                	UPDATE store
							                	SET last_payment_id = ?, subscriptionid = ?
							                	WHERE userid = ?
							                ";

							                $db->prepare($sql)->execute(array($payment_id, $_POST['subscriptionid'], $_SESSION['id']));
							                
							                //auto verify
							                $sql = "
							                	UPDATE user
							                	SET verified = 1
							                	WHERE id = ?
							                ";	

							                $db->prepare($sql)->execute(array($_SESSION['id']));

							                $_SESSION['verified'] = 1;

							                //add notification 
						                	$title = "Subscription Payment: Card";
											$body = "<p>".$_SESSION['storename']." paid a monthly subscription.</p>";
											$sql = "
												insert into notification(title,body,storeid, type)
												values(?,?,?, ?)
											";

											$db->prepare($sql)->execute(array($title, $body, $_SESSION['storeid'], "cardSubscription"));
							            } 

							            echo '<div class="alert alert-success" role="alert">
										        <h4 class="alert-heading">Well done!</h4>
										        
										        <p>Payment was successful! You have verified your account.</p>
										        <p>Click <a href="dashboard.php">here</a> to redirect to dashboard.</p>
										        <hr>
							  				</div>';
							        } else {
							            // payment failed: display message to customer
							            echo ' <br/><div class="alert alert-danger" role="alert">'.$response->getMessage().'</div>';
							        }
							    } catch(Exception $e) {
							            echo ' <br/><div class="alert alert-danger" role="alert">'.$response->getMessage().'</div>';
							    }
							}
						 ?>
					</div>
				
				</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
	<script src="./js/card.js"></script>

	<?php include_once "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$(".type").on("click", function(){
					var me = $(this);
					var val = me.val();

					console.log(val);
					if(val == "cash"){
						$("#cash").removeClass("hidden");
						$("#card").addClass("hidden");

					} else {
						$("#card").removeClass("hidden");
						$("#cash").addClass("hidden");
					}

				});

		         $(".card").on("click", function(){
					var me = $(this);
					var price = me.data("price");

					$(".border-success").find(".text-success").removeClass("text-success");
					$(".border-success").removeClass("border-success");

					me.addClass("border-success");
					me.find(".card-body").addClass("text-success");

					$("#amount").val(price);
					$("#amount2").val(price);
					$("#subscriptionid").val(me.data("id"));
					console.log(me.data);
				});  

		         $("#payment-form").on("submit", function(){
         			$(".preloader").removeClass("hidden");
		         });
			});
		})(jQuery);
	</script>
</body>
</html>