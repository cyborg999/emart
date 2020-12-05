<?php include_once "./head.php"; ?>
<body>
	<div class="container-sm">
		<?php include_once "./admindashboardnav.php"; ?>
		<div class="row">
			<br>
			<div class="col-sm-3">
				<?php 
					$users = $model->getAllUsers();
				 	$active = "users"; 
				 	include "./adminsidenav.php"; ?>
			</div>
			<div class="col-sm-9">
				<?php  include_once "./error.php"; ?>
				<table class="table">
					<thead>
						<tr>
							<th>Username</th>
							<th>Contact #</th>
							<th>Email</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $idx => $u): ?>
						<tr>
							<td><a href="" data-toggle="modal" data-target="#checkPayment"><?= $u['username'];?></a></td>
							<td><?= $u['contact'];?></td>
							<td><?= $u['email'];?></td>
							<td><span class="badge <?= (!$u['verified']) ? 'btn-warning' : 'btn-info'; ?>""><?= ($u['verified']) ? 'verified' : 'unverified'; ?></span></td>
							<td><a href="" data-verify="<?= $u['verified'];?>" data-id="<?= $u['id'];?>" class="verify btn btn-sm <?= ($u['verified']) ? 'btn-danger' : 'btn-success'; ?>"><?= (!$u['verified']) ? 'verify' : 'unverify'; ?></a></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>



<!-- Modal -->
<div class="modal fade" id="checkPayment" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
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
            <h5>To Do</h5>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	<?php include_once "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				function __listen(){
					$(".verify").off().on("click", function(e){
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
									me.removeClass("btn-danger");
									me.addClass("btn-success");

									me.html("verify")

									me.parents("tr").find(".badge").html("unverified");
									me.parents("tr").find(".badge").removeClass("btn-info");
									me.parents("tr").find(".badge").addClass("btn-warning");
								} else {
									me.addClass("btn-danger");
									me.removeClass("btn-success");
									me.html("unverify")

									me.parents("tr").find(".badge").html("verified");
									me.parents("tr").find(".badge").removeClass("btn-warning");
									me.parents("tr").find(".badge").addClass("btn-info");
									
								}

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