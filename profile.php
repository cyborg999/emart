<?php include_once "./head.php"; ?>
<body>
	<div class="container-sm">
		<?php include_once "./dashboardnav.php"; ?>
		<div class="row">
			<br>
			<div class="col-sm-3">
				<?php $profile = $model->getUserProfile(); $active = "user"; include "./sidenav.php"; ?>
			</div>
			<div class="col-sm-9">
				<?php  include_once "./error.php"; ?>
				<br>

				<style type="text/css">
					.banner {
						background: #eee;
						border-radius: 4px;
						min-height: 250px;
						position: relative;
						margin-bottom: 50px;
					}
					.store-logo-container {
						position: absolute;
						bottom: -20px;
						left: 20px;
						height: 150px;
						width: 150px;
						border-radius: 10px;
					}
					.store-logo {

					}
					#profilePreview {
						height: 200px;
						width: 200px;
					}
				</style>
				<div class="col-sm banner hidden">

				<!-- 	<form enctype="multipart/form-data" id="formProfileFrm" method="post">
						<input type="hidden" name="uploadpic">
						<input type="file" id="profile" name="profile" />
						<figure id="profilePreview"></figure>
					</form> -->
					<div class="store-logo-container">
						<?php if(file_exists("uploads/".$_SESSION['storeid'])): ?>
							<figure class="storelogo"></figure>
						<?php else: ?>
							<svg class="bi" width="150" height="150" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#image-fill"/></svg>
						<?php endif ?>
					</div>
				</div>
				<div class="col-sm">
					<?php include_once "./error.php"; ?>
					<form method="post">
						<input type="hidden" name="updateUserInfo" value="true">
					  <div class="form-row">
				  	 	<div class="form-group col-md-12">
					      <label for="inputPassword4">Full Name</label>
					      <input type="text" class="form-control" id="inputPassword4" value="<?= isset($profile['fullname']) ? $profile['fullname'] : '';?>" name="fullname">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputAddress">Address</label>
					    <input type="text" class="form-control" id="inputAddress" value="<?= isset($profile['address']) ? $profile['address'] : '';?>" name="address" placeholder="1234 Main St">
					  </div>
					  <div class="form-row">
					    <div class="form-group col-md-4">
					      <label for="inputCity">Birthday</label>
					      <input type="date" value="<?= isset($profile['bday']) ? $profile['bday'] : '';?>" name="birthday" class="form-control" id="inputCity">
					    </div>
					    <div class="form-group col-md-4">
					      <label for="inputState">Contact Number</label>
					      <input type="number"  class="form-control" id="inputState" value="<?= isset($profile['contact']) ? $profile['contact'] : '';?>" name="contact">
					    </div>
					    <div class="form-group col-md-4">
				       		<label for="inputEmail4">Email</label>
				      		<input type="email" name="email" class="form-control" value="<?= isset($profile['email']) ? $profile['email'] : '';?>" id="inputEmail4">
					    </div>
					  </div>
					  <button type="submit" class="btn btn-primary">Update</button>
					</form>
					  <br>
				</div>

			</div>
			
			
		</div>
	</div>

	<?php include_once "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$("#profile").on("change", function(){
					var preview = $(this).val();
					console.log("changed");
					console.log(preview);
					// $("#profilePreview").attr("src", preview);
					$("#formProfileFrm").trigger("submit");

				});

				$("#formProfileFrm").on("submit", function(e){
					var me = $(this);
					e.preventDefault();

					$.ajax({
						url : "ajax.php",
						data : me.serialize(),
						type : "post",
						dataType : "json",
						success : function(response){
						}
					});
				});

			});
		})(jQuery);
	</script>

</body>
</html>