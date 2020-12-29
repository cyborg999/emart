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
				<?php
				?>
			</div>
			<div class="col-sm-10">
				<?php  include_once "./error.php"; ?>
				<?php
					$fees = $model->getGlobalFees();
				?>
				<div class="content">
					<form method="post">
						<h5>Shipping Details</h5>
						<input type="hidden" name="updateShippingDetails">
						<textarea name="details" class="form-control" placeholder="Shipping Details"><?= ($fees) ? $fees['shipping_details'] : "";?></textarea>
						<br>
						<label>Days</label>
						<input type="number" class="form-control" name="ship_days" placeholder="Shipping Days..." value="<?= ($fees) ? $fees['shipping_day'] : "";?>" />
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