<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "settings"; include "./sidenav.php";?>

			</div>
			<div class="col-sm-10">
				<style type="text/css">
					#logo {
						width: 100px;
						height: auto;
					}
				</style>
				<?php  include_once "./error.php"; ?>
				<?php
					$store = $model->getStoreById($_SESSION['storeid']);
				?>
				<div class="content">
					<form method="post" enctype="multipart/form-data">
						<h3><?= $store['name'];?>'s Details</h3>
						<input type="hidden" name="updateStore" value="true">
						<div class="form-group">
							<label>Logo</label>
							<br>
							<img id="logo" src="<?= ($store) ? $store['logo'] : '';?>">
							<br>
							<br>
							<input type="file" name="storelogo" />
						</div>
							<br>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" placeholder="Description"><?= ($store) ? $store['description'] : '';?></textarea>
						</div>
						<div class="form-group">
							<label>Allow Pickup?
								<input id="allow" type="checkbox" name="allow_pickup">
							</label>
						</div>
						<div class="form-group  location hidden">
							<label>Pickup Location</label>
							<textarea class="form-control" name="pickup_location" placeholder="Pickup Location"></textarea>
						</div>
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
				$("#allow").on("click", function(){
					var me = $(this);

					if(me.is(":checked") == true){
						$(".location").first().removeClass("hidden");
					} else {
						$(".location").first().addClass("hidden");
					}
				});
			});
		})(jQuery);
	</script>
</body>
</html>