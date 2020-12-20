<?php include "./head2.php";?>
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
				<?php $active="user"; include "./usersidenav.php";?>
			</div>
			<div class="col-sm-10">
				<style type="text/css">
					label{
						margin-bottom: 5px;
					}
				</style>
				<div class="content">
					<?php  include_once "./error.php"; ?>
					<br>
					<h5>Change Password</h5>
					<form id="resetfrm" method="post" >
						<input type="hidden" name="resetpassword" value="true">
						<div class="form-group">
							<label>Old Password</label>
							<input type="password" value="<?= (isset($_POST['oldpassword'])) ? $_POST['oldpassword'] : '';?>" class="form-control" name="oldpassword" placeholder="Old Password..." required/>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '';?>" class="form-control" name="password" placeholder="New Password..." required/>
						</div>
						<div class="form-group">
							<label>Retype Password</label>
							<input type="password" value="<?= (isset($_POST['password1'])) ? $_POST['password1'] : '';?>" class="form-control" name="password1" placeholder="Retype New Password..." required/>
						</div>
						<br>
						<input type="submit" class="btn btn-primary btn-l" value="Update">
					</form>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
</body>
</html>