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
				<?php $active="settings"; include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">

				<div class="content">
					<?php
						$categories = $model->getAllCategories();
					?>
					<style type="text/css">
						.sv {
							color: black;
						}
					</style>
					<table class="table">
						<thead>
							<tr>
								<th>Category</th>
								<th>isDisplayed</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<tr>
								<td colspan="2">
									<input type="text" class="form-control" id="name" placeholder="Category">
								</td>
								<td>
									<a href="" class="add sv"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg></a>
								</td>
							</tr>
							<?php foreach($categories as $idx => $c): ?>
							<tr>
								<td><?= $c['name'];?></td>
								<td>
									<input type="checkbox" data-id="<?= $c['id'];?>" class="status" name="status" <?= ($c['isactive']) ? 'checked' : ''; ?>>
								</td>
								<td>
									<a href="" data-id="<?= $c['id'];?>" class="delete sv">
										<svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg>
									</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>


			</div>
		</div>
	</div>

	<!-- tpl scripts -->
	<script type="text/html" id="tr">
		<tr>
			<td>[NAME]</td>
			<td>
				<input type="checkbox" data-id="[ID]" class="status" name="status" [STATUS]>
			</td>
			<td>
				<a href="" data-id="[ID]" class="delete sv">
					<svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg>
				</a>
			</td>
			</tr>
	</script>
	<!-- end tpl scripts -->
	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			function __listen(){
				$(".delete").off().on("click", function(e){
					e.preventDefault();

					var me = $(this);

					$.ajax({
						url  : "ajax.php",
						data :{ deleteCategory : true, id : me.data("id")} ,
						type : "post",
						dataType: "json",
						success : function(response){
							me.parents("tr").remove();
						}
					});
				});

				$(".status").off().on("click", function(e){

					var me = $(this);
					var checked = me.is(":checked");

					$.ajax({
						url  : "ajax.php",
						data :{ updateStatus : true, id : me.data("id"), checked:(checked) ? 1 : 0} ,
						type : "post",
						dataType: "json",
						success : function(response){
							console.log(response);
						}
					});
				});
			}

			$(".add").off().on("click", function(e){
				e.preventDefault();

				var name = $("#name").val();
				var status = $("#status").is(":checked");

				console.log(name, status);

				$.ajax({
					url  : "ajax.php",
					data :{ addCategory : true, name : name, status : status} ,
					type : "post",
					dataType: "json",
					success : function(response){
						var tpl = $("#tr").html();

						tpl = tpl.replace("[NAME]", name).
							replace("[STATUS]", (status) ? 'checked' : '').
							replace("[ID]", response).
							replace("[ID]", response);

						$("#tbody").append(tpl);

						__listen();
						console.log(response);
					}
				});
			});

			__listen();
		})(jQuery);
	</script>
</body>
</html>