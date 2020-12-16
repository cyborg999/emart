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
				<div class="content">
					<form method="post">
						<h5>Shipping & Handling</h5>
						<input type="hidden" name="feeId" value="">
						<input type="hidden" name="updateGlobalFee" value="true">
						<input type="text" value="<?= (isset($_POST['shipping'])) ? $_POST['shipping'] : "";?>" class="form-control" required=""  name="shipping">
						<br>
						<h5>Tax</h5>
						<input type="text" value="<?= (isset($_POST['tax'])) ? $_POST['tax'] : "";?>" class="form-control" required name="tax">
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