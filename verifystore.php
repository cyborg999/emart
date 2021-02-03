<?php include "./adminhead.php";?>
<body>
<?php include "./spinner.php";?>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="user";include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content row">
					<div class="col-sm">
						<h5>Store Verification</h5>
					</div>
				</div>
				<div class="row content">
					<div class="col-sm">
						<?php 
							$users = $model->getAllStores();

							// op($users);
						?>
						<?php  include_once "./error.php"; ?>

						<table class="table">
							<thead>
								<tr>
									<th>Store Name</th>
									<th>Position</th>
									<th>Contact #</th>
									<th>Email</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($users as $idx => $u): ?>
								<tr>
									<td><a href="" data-id="<?= $u['userid'];?>" class="view"><?= $u['name'];?></a></td>
									<td><?= $u['position'];?></td>
									<td><?= $u['b_contact'];?></td>
									<td><?= $u['b_email'];?></td>
									<td><span class="badge <?= (!$u['verified']) ? 'btn-warning' : 'btn-info'; ?>""><?= ($u['verified']) ? 'verified' : 'suspended'; ?></span></td>
									<td>
										<a href="" data-toggle="modal" data-target="#updateModal" class="verify1 btn btn-sm <?= ($u['verified']) ? 'btn-danger' : 'btn-success'; ?>"><?= (!$u['verified']) ? 'verify' : 'suspend'; ?></a>

										<a href="" data-verify="<?= $u['verified'];?>" data-id="<?= $u['userid'];?>" class="verify2 hidden btn btn-sm <?= ($u['verified']) ? 'btn-danger' : 'btn-success'; ?>"><?= (!$u['verified']) ? 'verify' : 'suspend'; ?></a></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- Modal -->
<div class="modal fade" id="updateModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
            <h5>Please enter your password to update this record.</h5>
            <form id="updateVerify">
            	<input type="hidden" name="updateVerify" value="true">
	            <input type="password" id="password" class="password form-control" name="password">
	            <br>
    	        <input type="submit" class="btn btn-lg btn-primary" value="submit" >
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


	<!-- Modal -->
	<div class="modal fade" id="checkPayment" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Store Information</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	        <div class="row  ">
	          <div class="col-sm msg hidden"></div>
	        </div>
	        <div class="row">

	          <div class="col-sm">
	            <table class="table">
	            	<tbody id="tbody">
	            		
	            	</tbody>
	            </table>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/html" id="tpl">
		<tr>
			<th>Name:</th>
			<td>[NAME]</td>
		</tr>
		<tr>
			<th>Address:</th>
			<td>[ADDRESS]</td>
		</tr>
		<tr>
			<th>Contact:</th>
			<td>[CONTACT]</td>
		</tr>
		<tr>
			<th>Email:</th>
			<td>[EMAIL]</td>
		</tr>
		<tr>
			<th>Store:</th>
			<td>[STORE]</td>
		</tr>
		<tr>
			<th>Business Contact:</th>
			<td>[BCONTACT]</td>
		</tr>
		<tr>
			<th>Business Email:</th>
			<td>[BEMAIL]</td>
		</tr>
	</script>

	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				var last = null;
				var lastMe = null;

				$("#updateVerify").on("submit", function(e){
					e.preventDefault();

					$.ajax({
						url : "ajax.php",
						data : $(this).serialize(),
						type : "post",
						dataType : "json",
						success : function(response){
							if(response == "true"){
								$(last).trigger("click");

								$("#updateModal").modal("hide");
							} else {
								alert("Incorrect Password");
							}
						}
					});
				});

				function __listen(){
					$(".view").off().on("click", function(e){
						e.preventDefault();

						var me = $(this);

						showPreloader();

						$("#tbody").html("");

						$.ajax({
							url : "ajax.php",
							data : { viewUser : true, id : me.data("id")},
							type : "post",
							dataType : "json",
							success : function(response){
								console.log(response);

								if(response){
									var tpl = $("#tpl").html();

									tpl = tpl.replace("[NAME]", response.fullname).
										replace("[ADDRESS]", response.address).
										replace("[CONTACT]", response.contact).
										replace("[EMAIL]", response.email).
										replace("[STORE]", response.store).
										replace("[BCONTACT]", response.storecontact).
										replace("[BEMAIL]", response.storeemail);

									$("#tbody").append(tpl);
									$("#checkPayment").modal("show");
								}
							}
							, complete : function(){
								hidePreloader();
							}
						});

					});
					$(".verify1").off().on("click", function(){
						var me = $(this);

						$("#password").val("");

						lastMe = me;
						last = me.parent("td").find(".verify2");
					});

					$(".verify2").off().on("click", function(e){
						e.preventDefault();

						var me = $(this);

						console.log(me.data("verify"));
						$.ajax({
							url : "ajax.php",
							data : { 
								verifyUser : true, 
								id : me.data("id"), 
								verify : me.data("verify")
							},
							type : "post",
							dataType : "json",
							success : function(response){
								if(me.hasClass("btn-danger")){
									lastMe.removeClass("btn-danger");
									me.removeClass("btn-danger");
									lastMe.addClass("btn-success");
									me.addClass("btn-success");

									lastMe.html("verify")
									me.html("verify")

									lastMe.parents("tr").find(".badge").html("suspended");
									me.parents("tr").find(".badge").html("suspended");
									lastMe.parents("tr").find(".badge").removeClass("btn-info");
									me.parents("tr").find(".badge").removeClass("btn-info");
									lastMe.parents("tr").find(".badge").addClass("btn-warning");
									me.parents("tr").find(".badge").addClass("btn-warning");
								} else {
									lastMe.addClass("btn-danger");
									me.addClass("btn-danger");
									lastMe.removeClass("btn-success");
									me.removeClass("btn-success");
									lastMe.html("suspend")
									me.html("suspend")

									lastMe.parents("tr").find(".badge").html("verified");
									me.parents("tr").find(".badge").html("verified");
									lastMe.parents("tr").find(".badge").removeClass("btn-warning");
									me.parents("tr").find(".badge").removeClass("btn-warning");
									lastMe.parents("tr").find(".badge").addClass("btn-info");
									me.parents("tr").find(".badge").addClass("btn-info");
									
								}

								lastMe.data("verify", (lastMe.data("verify") == 0) ? 1 : 0);
								me.data("verify", (me.data("verify") == 0) ? 1 : 0);
							}
						});
					});
				}

				__listen();
			});
		})(jQuery);
	</script>
</body>
</html>