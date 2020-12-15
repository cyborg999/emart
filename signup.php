<?php include "./head3.php"; ?>
<body>
	<div class="container-sm">
	<?php include_once "./nav.php"; ?>
	<style type="text/css">
		.slider {
			position: relative;
			overflow: hidden;
			min-height: 80vh;
		}	
		.slider-container {
			width: 400%;
			position: absolute;
			min-height: 80vh;
			background: white;
		}
		.success {
			position: absolute;
			z-index: 3;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			background: white;
		}
		.hidden {
			display: none;
		}
		.form {
			width: 50%;
			display: block;
			margin: 20px auto;
			background: #fbfbfb;
		    padding: 20px;
		    border-radius: 20px;
		}

	</style>
	<br>
	<div class="row slider final">
		<div class="slide success hidden">
	      <div class="alert alert-success" role="alert">
	        <h4 class="alert-heading">Well done!</h4>
	        <p>You have succesfully registered an account.</p>
	        <hr>
	        <p class="mb-0">Click <a href="login.php">here</a> to login.</p>
	      </div>
		</div>
		<div class="slider-container row">
			<?php include_once "./spinner.php"; ?>
			
			<div class="signup slide col-sm active">
				<form method="post"  class="form">
					<h3>Sign Up</h3>
					<input type="hidden" name="signup" value="true"/>
					<br>
					<div class="err"></div>
				    <div class="form-group col-lg-12">
						<label>Username</label>
						<input type="text" value="" class="form-control" name="username" placeholder="Username..." required/>
					</div>
				    <div class="form-group col-lg-12">
						<label>Password</label>
						<input type="password" value="" class="form-control" name="password" placeholder="Password..." required/>
					</div>
				    <div class="form-group col-lg-12">
				    	<label>Retype Password</label>
				    	<input type="password" value="" class="form-control" name="password1" placeholder="Password..." required/>
					</div>
					<br>
					<div class="form-group col-lg-12">
						<button class="btn btn-success btn-lg">Next </button>
						<a href="" data-target=".usertype" data-left="-100%" class="disabled next hidden">Next</a>
					</div>		
				</form>
				<br>
			</div>

			<div class="usertype slide col-sm">
				<form method="post" class="form">
					<div class="err"></div>
					<h3>Are you a client or a merchant?</h3>
					<br>
					<input type="hidden" name="updateUserType" value="true"/>
				    <div class="form-group col-lg-12">
						<label for="client">Customer</label>
						<input type="radio" class="form-control usertype" id="client" name="usertype" checked value="client"/>
						<br>
						<label for="merchant">Merchant</label>
						<input type="radio" class="form-control usertype" id="merchant" name="usertype" value="merchant"/>
				    </div>
					<div class="form-group col-lg-12">
						<a href="" data-target=".usertype"  data-left="0%" class="next enabled"><svg class="bi" width="50" height="50" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#chevron-compact-left"/></svg></a>

						<button class="btn btn-success btn-lg">Next </button>
						<a href="" data-target=".store" data-left="-200%"  class="typeNext disabled next hidden ">Next</a>
					</div>	
				</form>
			</div>
			<div class="store slide col-sm">
				<form method="post" class="form">
					<div class="err"></div>
					<input type="hidden" name="addstore" value="true">
					<h3>Store Name</h3>
					<br>
					<input type="text" class="form-control" name="name" value="" placeholder="Store Name..." required/>
					<br>
					<br>
					<a href="" data-target=".usertype"  data-left="-100%" class="next enabled"><svg class="bi" width="50" height="50" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#chevron-compact-left"/></svg></a>

					<button class="btn btn-success btn-lg float-right">Next</button>
				</form>
				<a href="" data-target=".plan" data-left="-300%"  data-target="store" class="disabled next hidden">Next</a>
			</div>
			
			<div class="plan slide  col-sm final">
				<div class="row">
					<div class="col-sm">
						<form method="post" class="form">
							<h3>Personal Information</h3>
							<input type="hidden" name="plan" value="true">
						  <div class="form-row">
					  	 	<div class="form-group col-md-12">
						      <label for="inputPassword4">Full Name</label>
						      <input type="text" class="form-control" id="inputPassword4" required value="" name="fullname">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputAddress">Address</label>
						    <input type="text" class="form-control" required id="inputAddress" value="" name="address" placeholder="1234 Main St">
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-4">
						      <label for="inputCity">Birthday</label>
						      <input type="date" value="" name="birthday" required class="form-control" id="inputCity">
						    </div>
						    <div class="form-group col-md-4">
						      <label for="inputState">Contact Number</label>
						      <input type="number"  class="form-control" required id="inputState" value="" name="contact">
						    </div>
						    <div class="form-group col-md-4">
					       		<label for="inputEmail4">Email</label>
					      		<input type="email" name="email" required class="form-control" value="" id="inputEmail4">
						    </div>
						  </div>
						  	<a href="" id="planNext" data-target=".store"  data-left="-200%" class="next enabled "><svg class="bi" width="50" height="50" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#chevron-compact-left"/></svg></a>

						  <button type="submit" class="btn btn-lg btn-success">Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>	
	<div class="row">
		<div class="col-sm finish hidden">
		   	<div class="alert alert-success" role="alert">
		        <h4 class="alert-heading">Well done!</h4>
		        <p>You have succesfully registered a new store. </p>
		        <hr>
		        <p class="mb-0">Click <a href="login.php">here</a> to login.</p>
	      	</div>
		</div>
	</div>

	<?php include_once "./foot.php"; ?>
	<script type="text/html" id="errors">

		<div class="alert alert-danger" style="margin-top: 5px;" role="alert">[MESSAGE]</div>
	</script>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				function __listen() {
					$(".enabled").off().on("click", function(e){
						e.preventDefault();

						var me = $(this);

						if(me.hasClass("typeNext")){
							var val = $(".usertype:checked").val();
							var target = me.parents(".slide").find(".next");

							if(val == "client"){
								me.data("target", ".plan");
								me.data("left", "-300%");

								$("#planNext").data("target", ".usertype");
								$("#planNext").data("left", "-100%");
							} else {
								me.data("target", ".store");
								me.data("left", "-200%");

								$("#planNext").data("target", ".usertype");
								$("#planNext").data("left", "-200%");
							}
						}

						console.log(me.data("left"));
						$(".slider-container").stop().animate({
							"left" : me.data("left")
						});
						
					});

					$(".disabled").off().on("click", function(e){
						e.preventDefault();
						e.stopPropagation();
					});
				}


				__listen();


				$(".card").on("click", function(){
					var me = $(this);

					$(".border-success").find(".text-success").removeClass("text-success");
					$(".border-success").removeClass("border-success");

					me.addClass("border-success");
					me.find(".card-body").addClass("text-success");
				});

				$(".form").on("submit", function(e){
					e.preventDefault();

					var me = $(this);
					var data = me.serialize();

					// showPreloader();

					$("#err").html();

					$.ajax({
						url : "ajax.php",
						data : data,
						type : "post",
						dataType : 'json',
						success : function(response){
							hidePreloader();

							if(response.added){
								me.parents(".slide").find(".next").removeClass("disabled").addClass("enabled");
								var t = me.parents(".slide").find(".enabled");
								me.find(".err").first().html("");
								
								__listen();

								setTimeout(function(){
									t.trigger("click");
								},300)

								if(response.done){
									$(".success").removeClass("hidden");
								}
							} else {
								var errors = "";

								for(var i in response.errors){
									var tpl = $("#errors").html();

									errors = tpl.replace("[MESSAGE]", response.errors[i]);
								}

								me.find(".err").first().html(errors);
								me.parents(".slide").find(".next").removeClass("enabled").addClass("disabled");
							}
						}
					});
				});
			});

		})(jQuery);
	</script>
</body>
</html>