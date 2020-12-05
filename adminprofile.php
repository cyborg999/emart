<?php include "./adminhead.php";?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<figure class="logo"></figure>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
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
					      <input type="text" class="form-control" id="inputPassword4" value="<?= isset($profile['fullname']) ? $profile['fullname'] : '';?>" name="fullname" placeholder="Full Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputAddress">Address</label>
					    <input type="text" class="form-control" id="inputAddress" value="<?= isset($profile['address']) ? $profile['address'] : '';?>" name="address" placeholder="1234 Main St">
					  </div>
					  <div class="form-row">
					    <div class="form-group">
					      <label for="inputCity">Birthday</label>
					      <input type="date" value="<?= isset($profile['bday']) ? $profile['bday'] : '';?>" name="birthday" class="form-control" id="inputCity">
					    </div>
					    <div class="form-group">
					      <label for="inputState">Contact Number</label>
					      <input type="number"  class="form-control" id="inputState" value="<?= isset($profile['contact']) ? $profile['contact'] : '';?>" placeholder="Contact #" name="contact">
					    </div>
					    <div class="form-group">
				       		<label for="inputEmail4">Email</label>
				      		<input type="email" name="email" class="form-control" value="<?= isset($profile['email']) ? $profile['email'] : '';?>" id="inputEmail4" placeholder="Email">
					    </div>
					  </div>
					  <br>
					  <button type="submit" class="btn btn-success">Update</button>
					</form>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
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