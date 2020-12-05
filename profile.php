<?php include "./dchead.php";?>
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
				<?php $active="user"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<?php  include_once "./error.php"; ?>
					<?php $profile = $model->getUserProfile(); ?>
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
						#dropzone {
						padding: 30px 20px;
						margin: 20px auto;
						border: 5px dashed black;
						display: inline-block;
						width: 100%;
						position: relative;
						box-sizing: border-box;
						}
						.assets {
							background: #eee;
							padding: 10px 0;
						}
						.img {
							width: 100%;
							height: auto;
							display: block;
							margin: 0 auto;
							cursor: pointer;
						}
						.img:hover {
							width: 105%;
							box-shadow: 1px 1px 10px black;
						}
						.dz-image {
							float: left;
						}
						.img.active {
							border:2px solid yellow;
						}
						.dz-preview {
							float: left;
						}
						label {
							margin-top: 10px;
						}
					</style>
					<div class="col-sm banner hidden">
						<div class="store-logo-container">
							<form  id="dropzone" action="ajax.php">
								<input type="hidden" name="assetupload" value="true">
								<p class="caption">Drop files here</p>
							</form>
							<!-- 	<svg class="bi" width="150" height="150" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#image-fill"/></svg> -->
							
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
						      <input type="number"  class="form-control" id="inputState" value="<?= isset($profile['contact']) ? $profile['contact'] : '';?>" name="contact" placeholder="Contact #">
						    </div>
						    <div class="form-group">
					       		<label for="inputEmail4">Email</label>
					      		<input type="email" name="email" class="form-control" value="<?= isset($profile['email']) ? $profile['email'] : '';?>" id="inputEmail4" placeholder="Email">
						    </div>
						  </div>
						  <br>
						  <button type="submit" class="btn btn-success btn-lg">Update</button>
						</form>
					</div>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
</body>
</html>