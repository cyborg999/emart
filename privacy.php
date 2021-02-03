<?php include "./adminhead.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="footer"; include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="row content">
					<div class="col-sm">
						<h5>Privacy & Policy</h5>
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
							<input type="hidden" name="updateTerms" value="privacy">
							<textarea class="form-control" rows="10" name="privacy" placeholder="Privacy & Policy"><?= ($settings) ? $settings['privacy'] : ''; ?></textarea>
							<br>
							<input type="submit" class="btn btn-primary" value="Update" name="">
							<br>
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