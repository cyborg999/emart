<?php include_once "./head.php"; ?> 
<body>
	<div class="container-sm">
    	<?php include_once "./nav.php"; ?>
		<div class="row">
			<br>
			<div class="col-sm">
				<br>
				<div class="row">
				<div class="alert alert-success" role="alert">
			        <h4 class="alert-heading">Well done!</h4>
			        <?php
			        	if(isset($_SESSION['cart'])){
			        		unset($_SESSION['cart']);
			        	}
			        ?>
			        <p>Payment was successful! You have succesfully verified your account.</p>
			        <hr>
			        <p id="redirect">Redirecting in <span>3</span>.....</p>
  				</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				function timer(counter){
					setTimeout(function(){
			        	console.log(counter);
			        	$("#redirect span").html(counter);
			        	counter--;
			        	if(counter >= 1){
			        		timer(counter);
			        	} else {
			        		clearTimeout(timer);
			        		window.location = "dashboard.php";
			        	}



			        },1000);
				}
		        
		        localStorage.clear();
		        timer(3);
			});
		})(jQuery);
	</script>
