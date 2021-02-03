<?php include "./adminhead.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="user";include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">

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