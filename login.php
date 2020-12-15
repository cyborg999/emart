<?php include_once "./head.php"; ?>
<body>
	<div class="container-sm">
		<?php include_once "./nav.php"; ?>
		<div class="login"><br>
			<h4>Sign In</h4>
		  	<div class="form-group">
				<form method="post">
					<input type="hidden" name="login" value="true">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Username</label>
							<input type="text" value="<?= isset($_POST['username']) ? $_POST['username'] : '';?>" required class="form-control" name="username" placeholder="Username..."/>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
							<input type="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '';?>" required class="form-control" name="password" placeholder="Password..."/>
					  </div>
				<!-- 	  <div class="form-group form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1">
					    <label class="form-check-label" for="exampleCheck1">Check me out</label>
					  </div> -->
					  <br>
					  <button type="submit" class="btn btn-primary">Submit </button>
					  <br>
					  <br>
					  <hr>
					  <a href="signup.php">No Account Yet? Sign up here</a>
					</form>
				</div>
			<!-- errors -->
			<?php include_once "./error.php"; ?>
		</div>	
	</div>
	
	<?php include_once "./foot.php"; ?>
</body>
</html>