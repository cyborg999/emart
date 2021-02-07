<?php include "./adminhead.php";?>
<?php include "./spinner.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
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
									<a href="" class="add sv btn btn-sm btn-primary"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg> Add</a>
								</td>
							</tr>
							<?php foreach($categories as $idx => $c): ?>
							<tr class="level1">
								<td><a href="" data-id="<?= $c['id'];?>" class="viewLevel" data-toggle="modal" data-target="#updateModal"><?= $c['name'];?></a></td>
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

<style type="text/css">
	#levels {
		display: block;
	}
</style>
	<!-- Modal -->
<div class="modal fade" id="updateModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Category Levels <a href="" id="levels">
        	<span id="level1"></span>
        	<span id="level2"></span>
        	<span id="level3"></span>
        </a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
          	<h5>Level 2</h5>
          	<table class="table table-sm">
          		<thead>
          			<tr>
          				<th>Category Name</th>
          				<th>Action</th>
          			</tr>
          		</thead>
          		<tbody>
          			<tr id="level2tr">
						<td>
							<input type="text" class="form-control" id="name2" placeholder="Category">
						</td>
						<td>
							<a href="" class="add2 sv btn btn-sm btn-primary"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg> Add</a>
						</td>
					</tr>
          		</tbody>
          	</table>
            
          </div>
          <div class="col-sm hidden" id="tbl3">
          	<div  >
          		<h5>Level 3</h5>
	          	<table class="table table-sm">
	          		<thead>
	          			<tr>
	          				<th>Category Name</th>
	          				<th>Action</th>
	          			</tr>
	          		</thead>
	          		<tbody>
	          			<tr id="level3tr">
							<td>
								<input type="text" class="form-control" id="name3" placeholder="Category">
							</td>
							<td>
								<a href="" class="add3 sv btn btn-sm btn-primary"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg> Add</a>
							</td>
						</tr>
	          		</tbody>
	          	</table>
          	</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
	.lvl3 {
		cursor: pointer;
	} 
</style>

	<!-- tpl scripts -->
	<script type="text/html" id="tr">
		<tr>
			<td><a href="" data-id="[ID]" class="viewLevel" data-toggle="modal" data-target="#updateModal">[NAME]</a></td>
			<td>
				<input type="checkbox" data-id="[ID]" checked class="status" name="status" [STATUS]>
			</td>
			<td>
				<a href="" data-id="[ID]" class="delete sv">
					<svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg>
				</a>
			</td>
			</tr>
	</script>

	<script type="text/html" id="trLevel2">
		<tr class="tr2">
			<td><a href="" data-id="[ID]" class="viewLevel2">[NAME]</a></td>
			<td>
				<a href="" data-id="[ID]" class="delete sv">
					<svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg>
				</a>
			</td>
			</tr>
	</script>
	<script type="text/html" id="trLevel3">
		<tr class="tr3">
			<td class="lvl3">[NAME]</td>
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
				$(".lvl3").off().on("click", function(){
					var me = $(this);
					
					$("#level3").html(" > "+me.html())
				});

				$(".viewLevel2").off().on("click", function(e){
					e.preventDefault();

					var me = $(this);
					var id = me.data("id");
					var cat = me.html();

					$("#levels").data("level2", id);
					$("#level2").html(">"+cat);
					$(".tr3").remove();
					$("#tbl3").removeClass("hidden");
					$("#level3").html("");
					$("#name3").val("");

					showPreloader();

					$.ajax({
						url : "ajax.php",
						data : { getLevel3Category : true, id : me.data("id")},
						type : "post",
						dataType : "json",
						success : function(response){
							for(var i in response){
								var data = response[i];
								var tpl = $("#trLevel3").html();

								tpl = tpl.replace("[NAME]", data.name).
									replace("[ID]", data.id).
									replace("[ID]", data.id).
									replace("[ID]", data.id);

								$("#level3tr").after(tpl);

								__listen();
								console.log(data);
							}
						}
						, complete : function(){
							hidePreloader();
						}
					});
				});


				$(".viewLevel").off().on("click", function(){
					var me = $(this);
					var id = me.data("id");
					var cat = me.html();

					$("#levels").data("level1", id);
					$("#level1").html(cat);
					$(".tr2").remove();
					$("#tbl3").addClass("hidden");
					$("#level2").html("");
					$("#level3").html("");

					showPreloader();

					$.ajax({
						url : "ajax.php",
						data : { getLevel2Category : true, id : me.data("id")},
						type : "post",
						dataType : "json",
						success : function(response){
							for(var i in response){
								var data = response[i];
								var tpl = $("#trLevel2").html();

								tpl = tpl.replace("[NAME]", data.name).
									replace("[ID]", data.id).
									replace("[ID]", data.id).
									replace("[ID]", data.id);

								$("#level2tr").after(tpl);

								__listen();
								console.log(data);
							}
						}
						, complete : function(){
							hidePreloader();
						}
					});
				});

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

			$("#name2").on("keyup", function(){
				var me = $(this);
				var val = me.val();

				$("#level2").html("> "+val);

				if($("#tbl3").hasClass("hidden") == false){
					$("#tbl3").addClass("hidden");
				}
			});

			$("#name3").on("keyup", function(){
				var me = $(this);
				var val = me.val();

				$("#level3").html("> "+val);
			});

			$(".add3").off().on("click", function(e){
				e.preventDefault();

				var me = $(this);
				var name = $("#name3").val();

				if(name == ""){
					alert("Enter a category");

					return false;
				}

				showPreloader();

				$.ajax({
					url  : "ajax.php",
					data :{ 
						addCategory3 : true, 
						category1 : $("#levels").data("level2"), 
						breadCrumbs : $("#levels").html(), 
						name : name} ,
					type : "post",
					dataType: "json",
					success : function(response){
						if(response == "false") {
							alert("Category already exists");

							return false;
						}
						var tpl = $("#trLevel3").html();

						tpl = tpl.replace("[NAME]", name).
							replace("[ID]", response).
							replace("[ID]", response).
							replace("[ID]", response);

						$("#level3tr").after(tpl);

						__listen();
					}
					, complete : function(){
						$("#name3").val("");
						hidePreloader();
					}
				});
			});

			$(".add2").off().on("click", function(e){
				e.preventDefault();

				var me = $(this);
				var name = $("#name2").val();

				if(name == ""){
					alert("Enter a category");

					return false;
				}

				showPreloader();

				$.ajax({
					url  : "ajax.php",
					data :{ 
						addCategory2 : true, 
						category1 : $("#levels").data("level1"), 
						breadCrumbs : $("#levels").html(), 
						name : name} ,
					type : "post",
					dataType: "json",
					success : function(response){
						if(response == "false") {
							alert("Category already exists");

							return false;
						}
						var tpl = $("#trLevel2").html();

						tpl = tpl.replace("[NAME]", name).
							replace("[ID]", response).
							replace("[ID]", response).
							replace("[ID]", response);

						$("#level2tr").after(tpl);

						__listen();
					}
					, complete : function(){
						$("#name2").val("");
						hidePreloader();
					}
				});
			});

			$(".add").off().on("click", function(e){
				e.preventDefault();

				var me = $(this);
				var name = $("#name").val();
				var status = $("#status").is(":checked");

				console.log(name, status);
				if(name == ""){
					alert("Enter a category");

					return false;
				}

				$.ajax({
					url  : "ajax.php",
					data :{ addCategory : true, name : name, status : status} ,
					type : "post",
					dataType: "json",
					success : function(response){
						if(response == "false") {
							alert("Category already exists");

							return false;
						}
						var tpl = $("#tr").html();

						tpl = tpl.replace("[NAME]", name).
							replace("[STATUS]", (status) ? 'checked' : '').
							replace("[ID]", response).
							replace("[ID]", response).
							replace("[ID]", response);

						me.parents("tr").after(tpl);
						__listen();
					}
				});
			});

			__listen();
		})(jQuery);
	</script>
</body>
</html>