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
				<?php  $active = "settings"; include "./adminsidenav.php"; ?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<?php  include_once "./error.php"; ?>
					<br>
					<h5>All Slides</h5>
					<?php
						$slides = $model->getAllSlides();
					?>
					<style type="text/css">
						.img {
							width: 100%;
							height: auto;
							max-width: 200px;
						}
					</style>
					<table class="table">
						<thead>
							<tr>
								<th>Include</th>
								<th>Content</th>
								<th>Title</th>
								<th>Subtext</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($slides as $idx => $s): ?>
							<tr>
								<td>
									<input type="checkbox" class="status" name="status" <?= ($s['status']) ? "checked" : "";?> value="<?= $s['id'];?>">
								</td>
								<td><img class="img" src="<?= $s['photo'];?>"></td>
								<td><?= $s['title'];?></td>
								<td><?= $s['content'];?></td>
								<td>
									<a href="" data-id="<?= $s['id'];?>" class="btn  delete btn-danger btn-sm"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>


			</div>
		</div>
	</div>
	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$(".delete").on("click", function(e){
					e.preventDefault();

					var me = $(this);

					$.ajax({
						url : "ajax.php",
						data : { deleteSlide : true, id : me.data("id")},
						type : "post",
						dataType : "json",
						success : function(response){
							me.parents("tr").remove();
						}
					});

				});

				$(".status").on("click", function(e){
					var me = $(this);
					var checked = me.is(":checked");

					$.ajax({
						url : "ajax.php",
						data : { 
							updateSlideStatus : true,
							id : me.val(),
							status : checked
						},
						type : "post",
						dataType : "json",
						success : function(response){
							console.log(response);
						}
					});

				});
			});
		})(jQuery);
	</script>
</body>
</html>