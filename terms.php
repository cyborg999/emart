<?php include "./adminhead.php";?>
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
				<?php $active="footer"; include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="row content">
					<div class="col-sm">
						<h5>Terms & Conditions</h5>
					</div>
				</div>
				<div class="content row">
					<div class="col-sm">
						<?php include_once "./error.php"; ?>
						<?php
							$settings = $model->getAdminSetting();
						?>
						<br>
						<form method="post" action="">
							<input type="hidden" name="updateTerms" value="terms">
							<textarea class="form-control" rows="10" name="terms" placeholder="Terms & Conditions"><?= ($settings) ? $settings['terms'] : ''; ?></textarea>
							<br>
							<input type="submit" class="btn btn-primary" value="Update" name="">
						</form>
					</div>
				</div>


			</div>
		</div>
	</div>

	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			
		})(jQuery);
	</script>
</body>
</html>