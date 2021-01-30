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
				?>

				<div class="row">
					<div class="col-sm">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Store</a>
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
										<h3>Personal Details</h3>
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
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane row fade" id="profile" role="tabpanel" aria-labelledby="home-tab">
							<div class="col-sm">
								<br>
								<?php
									$store = $model->getUserStore();
								?>
								<form method="post">
									<input type="hidden"  name="updateBusiness" value="true">
									<div class="col-sm">
										<h3><?= $store['name'];?>'s Details</h3>
										<div class="form-group">
											<label>Business</label>
											<input type="text" readonly class="form-control" placeholder="Store Name..." name="store" value="<?= ($store) ? $store['name'] : '';?>">
										</div>
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control" name="description" placeholder="Description..."><?= ($store) ? $store['description'] : '';?></textarea>
										</div>
										<div class="form-group">
											<label>Business Address</label>
											<input type="text" class="form-control" placeholder="Address..." name="b_address" value="<?= ($store) ? $store['b_address'] : '';?>">
										</div>
										<div class="form-group">
											<label>DTI</label>
											<input type="text" class="form-control" placeholder="DTI..." name="dti" value="<?= ($store) ? $store['dti'] : '';?>">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" placeholder="Email..." name="b_email" value="<?= ($store) ? $store['b_email'] : '';?>">
										</div>
										<div class="form-group">
											<label>Contact #</label>
											<input type="text" class="form-control" placeholder="Contact #..." name="b_contact" value="<?= ($store) ? $store['b_contact'] : '';?>">
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