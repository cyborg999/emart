<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<a href="index.php"><figure class="logo"></figure></a>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "settings"; include "./sidenav.php";?>

			</div>
			<div class="col-sm-10">
				<?php  include_once "./error.php"; ?>
				<?php
					$fees = $model->getGlobalFees();
				?>
				<div class="content">
					<form method="post">
						<h5>Shipping Fee</h5>
						<input type="hidden" name="feeId" value="">
						<input type="hidden" name="updateGlobalFee" value="true">
						<input type="text" value="<?= ($fees) ? $fees['shipping'] : "";?>" class="form-control" required="" placeholder="Shipping Fee" name="shipping">
						<br>
						<h5>Tax</h5>
						<input type="text" value="<?= ($fees) ? $fees['tax'] : "";?>" class="form-control" placeholder="Tax" required name="tax">
						<br>
						<h5>Minimum Purchase Total</h5>
						<input type="text" min="1" value="<?= ($fees) ? $fees['minimum'] : "1";?>" class="form-control" placeholder="Minimum Purchase" required name="minimum">
						<br>
						<button class="btn btn-lg btn-primary" id="save">Save</button>
					</form>
					
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
			
			});
		})(jQuery);
	</script>
</body>
</html>