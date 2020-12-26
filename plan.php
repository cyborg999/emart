<?php include "./adminhead.php";?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<a href="./index.php"><figure class="logo"></figure></a>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $subscription = $model->getAllSubscription(); $active = "settings"; include "./adminsidenav.php"; ?>
			</div>
			<div class="col-sm-10">

				<div class="content row">
					<div class="col-sm">
						<?php  include_once "./error.php"; ?>
						<a href="" class="add" data-toggle="modal" data-target="#addPlan"><svg class="bi" width="30" height="30" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg></a>
						<br>
					</div>
					<style type="text/css">
						.add {
							background: rgba(0,0,0,.1);
							padding: 20px;
							border-radius: 15px;
							display: inline-block;
							/*width: 90px;*/
							margin-top: 10px;
							color: #484848;
						}
						.card {
							cursor: pointer;
						}
						.delete {
							float: right;
						}
					</style>
					
				</div>
				<div class="content row">

					<?php foreach($subscription as $idx => $sub): ?>
						<div class="col-sm-3 cardd">
							<div class="card mb-3 <?= ($sub['active']) ? 'border-success' : '';  ?>"  data-id="<?= $sub['id'];?>" style="max-width: 18rem;">
							  <div class="card-header"><?= $sub['title'];?> <a class="delete" data-id="<?= $sub['id'];?>" href=""><svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a></div>
							  <div class="card-body <?= ($sub['active']) ? 'text-success' : '';  ?>">
							    <h5 class="card-title"><?= $sub['caption'];?></h5>
							    <p class="card-text"><?= $sub['cost'];?>/<small>Month</small></p>
							  </div>
							</div>
						</div>
					<?php endforeach ?>
				</div>

			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="addPlan" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add New Subscription</h5>
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
	            <form method="post" action="">
	            	<input type="hidden" name="addPlan" value="true">
	            	<div class="form-group">
	            		<label>Title</label>
	            		<input type="text" class="form-control" required name="title">
	            	</div>
	            	<div class="form-group">
	            		<label>Plan Duration #(month)</label>
	            		<input type="number" class="form-control" required name="planduration">
	            	</div>
	            	<div class="form-group">
	            		<label>Plan Caption</label>
	            		<input type="text" class="form-control" required name="plancaption">
	            	</div>
	            	<div class="form-group">
	            		<label>Fee</label>
	            		<input type="text" class="form-control" required name="planfee">
	            	</div>
	            	<input type="submit" class="btn btn-primary" name="">
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

	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
			     $(".card").on("click", function(){
					var me = $(this);

					me.toggleClass("border-success");
					me.find(".card-body").toggleClass("text-success");


			    	$.ajax({
			    		url : "ajax.php",
			    		data : { activatePlan : true, id : me.data("id"), toggle : (me.hasClass("border-success") ? 1 : 0)},
			    		type : "post",
			    		dataType : "json",
			    		success : function(){

			    		}
			    	});
				}); 

			    $(".delete").on("click", function(e){
			    	e.preventDefault();
			    	e.stopPropagation();

			    	var me = $(this);

			    	$.ajax({
			    		url : "ajax.php",
			    		data : { deletePlan : true, id : me.data("id")},
			    		type : "post",
			    		dataType : "json",
			    		success : function(){
			    			me.parents(".cardd").remove();
			    		}
			    	});
			    });
			});
		})(jQuery);
	</script>
</body>
</html>