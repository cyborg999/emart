<?php include "./dchead.php";

require_once "vendor/autoload.php";
use Omnipay\Omnipay;
$check = $model->preventReaccessIfPayed();
$host = "localhost";
$dbname = "emart";
$username = "root";
$password = "";
$charset = "utf8";

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password);
?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<figure class="logo"></figure>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
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
				<div class="row">
					<?php 					
					$store = $model->getUserStore();
					$amount = $store['cost'] * $store['duration'];
					$subscription = $model->getActiveSubscriptions();

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
						                	SET last_payment_id = ?
						                	WHERE userid = ?
						                ";

						                $db->prepare($sql)->execute(array($payment_id, $_SESSION['id']));
						                
						                //auto verify
						                $sql = "
						                	UPDATE user
						                	SET verified = 1
						                	WHERE id = ?
						                ";	

						                $db->prepare($sql)->execute(array($_SESSION['id']));

						                $_SESSION['verified'] = 1;
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
	<?php include "./foot.php"; ?>
	<script src="./js/card.js"></script>

	<?php include_once "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
		         $(".card").on("click", function(){
					var me = $(this);
					var price = me.data("price");

					$(".border-success").find(".text-success").removeClass("text-success");
					$(".border-success").removeClass("border-success");

					me.addClass("border-success");
					me.find(".card-body").addClass("text-success");

					$("#amount").val(price);
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