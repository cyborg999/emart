<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "user"; include "./sidenav.php";?>

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
					// opd($store);
				?>

				<div class="row">
					<div class="col-sm">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Store</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Business</a>
						  </li>
						</ul>
					</div>
				</div>

				<div class="content row">
					<div class="tab-content row" id="myTabContent">

						<div class="tab-pane row fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="col-sm">
								<br>
								<form method="post" enctype="multipart/form-data">
									<div class="col-sm">
										<h3>Store Details</h3>
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
												<input id="allow" type="checkbox" <?= ($store) ? ($store['allow_pickup'] == 1) ? 'checked' : '' : '';?> name="allow_pickup">
											</label>
										</div>
										<div class="form-group  location <?= ($store) ? ($store['allow_pickup'] == 1) ? '' : 'hidden' : 'hidden';?>">
											<label>Pickup Location</label>
											<textarea class="form-control" name="pickup_location" placeholder="Pickup Location"><?= ($store) ? $store['pickup_location'] : '';?></textarea>
										</div>
										<br>
										<button class="btn btn-lg btn-primary" id="save">Save</button>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane row fade" id="profile" role="tabpanel" aria-labelledby="home-tab">
							<div class="col-sm">
								<br>
								<?php
									$business = $model->getUserStore();
								?>
								<form method="post">
									<input type="hidden"  name="updateBusiness" value="true">
									<div class="col-sm">
										<h3>Business Details</h3>
										<div class="form-group">
											<label>Business</label>
											<input type="text" readonly class="form-control" placeholder="Store Name..." name="store" value="<?= ($business) ? $business['name'] : '';?>">
										</div>
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control" name="description" placeholder="Description..."><?= ($business) ? $business['description'] : '';?></textarea>
										</div>
										<div class="form-group">
											<label>Business Address</label>
											<input type="text" class="form-control" placeholder="Address..." name="b_address" value="<?= ($business) ? $business['b_address'] : '';?>">
										</div>
										<div class="form-group">
											<label>DTI</label>
											<input type="text" class="form-control" placeholder="DTI..." name="dti" value="<?= ($business) ? $business['dti'] : '';?>">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" placeholder="Email..." name="b_email" value="<?= ($business) ? $business['b_email'] : '';?>">
										</div>
										<div class="form-group">
											<label>Contact #</label>
											<input type="text" class="form-control" placeholder="Contact #..." name="b_contact" value="<?= ($business) ? $business['b_contact'] : '';?>">
										</div>
										<input type="submit" class="btn btn-primary" value="Update" name="">
									</div>
							</div>
						</div>
					</div>
					
					
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