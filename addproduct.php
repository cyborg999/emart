<?php include "./dchead.php";?>
<body>
    <?php include "./spinner.php"; ?>
    <?php
		$batchNumber = $model->getNextBatch();
	?>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="product"; include "./sidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm content">
						<label>New Product
							<input type="radio" name="type" class="type" checked value="productnew">
						</label>
						<label>New Batch of Product
							<input type="radio" name="type" class="type" value="productbatch">
						</label>
					</div>
				</div>
				<div class="row hidden" id="addbatch">
					<?php
						$products = $model->getStoreProducts();
					?>
					<div class="content col-sm">
						<h5>Add New Batch</h5>
						<form method="post" id="addNewBatch">
							<input type="hidden" name="addBatch" value="true">
							<div class="form-group">
								<label>Batch  #</label>
								<input type="text" readonly name="batch" class="form-control" value="<?= $batchNumber; ?>" placeholder="Batch #...">
							</div>
							<div class="form-group">
								<label>Product</label>
								<select class="form-control" name="products">
									<?php foreach($products as $idx => $p): ?>
										<option value="<?= $p['id'];?>"><?= $p['name'];?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label>Quantity</label>
								<input required type="number" min="1" name="qty" class="form-control" placeholder="Quantity...">
							</div>
							<div class="form-group">
								<label>Cost Price</label>
								<input required type="number" id="costPrice" name="cost" class="form-control" placeholder="Cost Price...">
							</div>
							<div class="form-group">
								<label>Retail Price</label>
								<input required type="number" id="retailPrice" name="retail" class="form-control" placeholder="Cost Price...">
							</div>
							<div class="form-group">
								<label>Expiration</label>
								<input required type="date" name="expiration" class="form-control" placeholder="Date Expired...">
							</div>
							<input type="submit" class="btn btn-primary" value="Submit" />
						</form>
					</div>
				</div>
				<div class="row" id="addnew">
					<div class="content col-sm">
						<br>
						<h5>Add Product</h5>

						<form  id="dropzone" action="ajax.php">
							<input type="hidden" name="assetupload" value="true">
							<p class="caption">Drop files here</p>
						</form>
						<style type="text/css">
							#dropzone {
								padding: 50px 20px;
								margin: 20px auto;
								border: 5px dashed #eee;
								display: inline-block;
								width: 100%;
								position: relative;
								box-sizing: border-box;
							}
							.assets {
								background: #eee;
								padding: 10px 0;
							}
							.img {
								width: 100%;
								height: auto;
								display: block;
								margin: 0 auto;
								cursor: pointer;
							}
							.img:hover {
								width: 105%;
								box-shadow: 1px 1px 10px black;
							}
							.dz-image {
								float: left;
							}
							.img.active {
								border:2px solid yellow;
							}
							.dz-preview {
								float: left;
							}
							label {
								margin-top: 10px;
							}
							.closeList {
								font-weight: bold;
								font-size: .9em;
								margin-left: 10px;								
							}
							.what {
								color: white;
								background: #007bff;
								width: 20px;
								height: 20px;
								border-radius: 100%;
								text-align: center;
								font-size: .8em;
								line-height: 2;
								font-weight: normal;
							}
						</style>
						<div class="row assets">
						</div>  
						<br> 
						
						<div class="row">
							
							<div class="col-sm">
								<form id="addSlider">
									<input type="hidden" name="addProduct" value="true">
									<div class="form-group">
										<label>Batch #</label>
										<input type="text" readonly  id="batch" required class="form-control" name="batch" value="<?= $batchNumber;?>" placeholder="Batch Number...">
									</div>
									<div class="form-group">
										<label>Name</label>
										<input type="text" required  id="name" required class="form-control" name="title" placeholder="Title...">
									</div>
								
									<div class="form-group">
										<label>Category</label>
										<br>
										<?php 
										$categories = $model->getAllCategories();
										 ?>
										<select id="category" name="category">
											<?php foreach($categories as $idx => $c): ?>
											<option value="<?= $c['id'];?>"><?= $c['name'];?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label>Cost Price</label>
										<input required type="number" id="cost" name="cost" class="form-control" placeholder="Cost Price">
									</div>
									<div class="form-group">
										<label>Retail Price</label>
										<input required type="number" id="price" name="price" class="form-control" placeholder="Retail Price">
									</div>
									<div class="form-group">
										<label>Brand</label>
										<input type="text" name="brand" id="brand" class="form-control" placeholder="Brand">
									</div>
									<div class="form-group">
										<label>Quantity</label>
										<input required type="number" min="1" id="quantity" name="quantity" class="form-control" placeholder="Quantity">
									</div>
									<div class="form-group">
										<label>Expiration Date</label>
										<input  type="date" id="expiration" name="expiration" class="form-control" required placeholder="Date Expire"/>
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" id="desc" name="desc"></textarea>
									</div>
									<div class="form-group">
										<style type="text/css">
											.sm {
												position: relative;
											}
											.sm:hover figure {
												display: block;
											}
											.list-fig {
												background: url(./images/list.png) no-repeat;
												width: 322px;
												height: 166px;
												background-size: contain;
												position: absolute;
												left: 0;
												top: 0;
												display: none;
											}
											.variant-fig {
												background: url(./images/variants.png) no-repeat;
												width: 322px;
												height: 166px;
												background-size: contain;
												position: absolute;
												left: 0;
												top: 0;
												display: none;
											}
										</style>
										<label>List Description 
											<small class="sm">
												<i  title="What is this?" class="fa fa-info what"></i>
												<figure class="list-fig"></figure>
											</small>

										</label>

										<ul id="list">
											<li>
												<input type="text" style="margin-right: 5px;" id="listdesc" class="float-left" name="">
												<a href="" class="addList btn btn-sm btn-primary">add +</a>
											</li>
										</ul>
									</div>
									<div class="form-group">
										<label>Variants
											<small class="sm">
												<i  title="What is this?" class="fa fa-info what"></i>
												<figure class="variant-fig"></figure>
											</small>
										</label>
										<table class="table">
										<thead>
											<tr>
												<th>Name</th>
												<th>Value</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr id="start">
												<td>
													<input type="text" class="form-control" id="variant" name="name"  placeholder="Variant...">
												</td>
												<td>
													<input  type="text" class="form-control" id="val" name="val" placeholder="Value...">
												</td>
												<td>
													<input type="submit" id="add" class="btn  btn-success" value="Add">
												</td>
											</tr>
											
										</tbody>
									</table>
									<a href="" id="generate">generate price list table</a>
									<br>
									<a href="" id="reset">reset table</a>
									</div>
									<br>
									<div class="row">
										<div class="col-sm">
											<table class="table tbl-sm">
												<thead>
													<tr>
														<th>Variant Combination</th>
														<th>Price</th>
														<th>Quantity</th>
													</tr>
												</thead>
												<tbody id="variantBody">
													
												</tbody>
											</table>
										</div>
									</div>
									<div class="row  ">
							          <div class="col-sm msg hidden"></div>
							        </div>
									<br>
									<input type="submit" class="btn btn-lg btn-success" value="Add">
								</form>
							</div>
						</div>	
					</div>
				</div>
				


			</div>
		</div>
	</div>

	<script type="text/html" id="variantBodyTr">
		<tr>
			<td class="combo">[COMBO]</td>
			<td><input type="number" min="1" class="form-control variantPrice" name="price" required class="price"></td>
			<td><input type="number" min="1" class="form-control variantQty" required name="qty" class="qty"></td>
		</tr>
	</script>
	<script type="text/html" id="variants">
		<tr class="trVariant">
			<td>
				<input type="text"  class="variant form-control" value="[VARIANT]">
			</td>
			<td>
				<input type="text"  class="val form-control" value="[VAL]">
			</td>
			<td>
				<a href="" data-id="[ID]" class="btn btn-danger btn-sm remove">remove</a>
			</td>
		</tr>
	</script>
	<!-- tpl scripts -->
	<script type="text/html" id="tpl">
		<div class="col-sm-2">
			<img class="img active" data-src="[SRC]" src="./uploads/merchant/<?= $_SESSION['storeid'];?>/[SRC]">
		</div>
	</script>
	<script type="text/html" id="success">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!!</strong> You have sucessfully added this product.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	</script>
	<script type="text/html" id="error">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!!</strong> [ERROR]
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	</script>
	<script type="text/html" id="li">
      <li class="li">
      	<input type="hidden" name="listdesc[]" class="listdesc" value="[NAME]">
      	[NAME] <a href="" class="closeList">x</a>
      </li>
	</script>
	<!-- end tpl scripts -->

	<?php include "./foot.php"; ?>
	<script src="./node_modules/chosen-js/chosen.jquery.min.js" ></script>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$("#add").on("click", function(e){
	    			e.preventDefault();
					e.stopPropagation();

	    			var me = $(this);
	    			var tr = me.parents("tr");
	    			var tpl = $("#variants").html();

	    			tpl = tpl.replace("[VARIANT]", tr.find("#variant").val()).
	    				replace("[VAL]", tr.find("#val").val());

	    			if(tr.find("#variant").val() == ""){
	    				alert("Please enter a variant name");
	    			} else {
		    			if(tr.find("#val").val() == ""){
		    				alert("Please enter a value");	
		    			} else {
	    					$("#start").after(tpl);

	    					__listen();

		    			}
	    			}
	    		});
				$(".addList").on("click", function(e){
					e.preventDefault();

					var name = $("#listdesc").val();
					var ul = $("#list");
					var li = $("#li").html();

					li = li.replace("[NAME]", name).
						replace("[NAME]", name);

					ul.find("li").last().after(li);
					$("#listdesc").val("");
					__listen();
				});

				$("#addNewBatch").on("submit", function(e){
					e.preventDefault();
					e.stopPropagation();

					var me = $(this);
					var cost = $("#costPrice").val();
					var retail = $("#retailPrice").val();

					if(parseFloat(cost) >= parseFloat(retail)){
						alert("Cost Price should be less than Retail Price");

						console.log(cost,retail);
						return;
					}

					showPreloader();

					$.ajax({
						url : "ajax.php",
						data : $(this).serialize() ,
						type : "post",
						dataType : "json",
						success : function(response){
			               
			                hidePreloader();
			                console.log(response);
			                window.location.href = "allproducts.php?id="+response;
						}
					});


				});

				$(".type").on("click", function(){
					var me = $(this);
					var val = me.val();
					console.log(val);

					if(val == "productnew"){
						$("#addnew").removeClass("hidden");
						$("#addbatch").addClass("hidden");
					} else {
						$("#addbatch").removeClass("hidden");
						$("#addnew").addClass("hidden");
					}

				});

				function __listen() {
					$(".remove").off().on("click", function(e){
	    				e.preventDefault();

	    				var me = $(this);

						me.parents("tr").remove();
	    			});

					$(".img").off().on("click", function(){
						var me = $(this);

						$(".img.active").removeClass("active");
						me.addClass("active");
					});

					$(".closeList").off().on("click", function(e){
						e.preventDefault();

						var me = $(this);
						me.parents(".li").remove();
					});
				}

				__listen();

				function getListDesc() {
					var data = Array();

					$("#list .li").each(function(){
						var me = $(this);
						var name = me.find(".listdesc").val();

						data.push(name);
					});

					return data;
				}

				function getVariants() {
					var data = Array();

					$(".trVariant").each(function(){
						var me = $(this);
						var variant = me.find(".variant").val();
						var variantVal = me.find(".val").val();

						data.push(Array(variant, variantVal));
					});

					return data;
				}

				function getVariantData() {
					var data = Array();

					$("#variantBody tr").each(function(){
						var me = $(this);
						var variant = me.find(".combo").html();
						var vPrice = me.find(".variantPrice").val();
						var vQty = me.find(".variantQty").val();

						data.push(Array(variant, vPrice, vQty));
					});

					return data;
				}

				$("#addSlider").on("submit", function(e){
					e.preventDefault();

					var img = $(".img.active");
					var imgs = Array();

					$(".msg").html("");
					
					$(".assets .img").each(function(){
						var me = $(this);
						var src = me.data("src");

						imgs.push(src);
					});

					if(img.length == 0){
						alert("Please select an image first.");
					} else {
						showPreloader();
						$.ajax({
							url : "ajax.php",
							data : {
								title : $("#name").val(),
								category : $("#category").val(),
								cost : $("#cost").val(),
								price : $("#price").val(),
								brand : $("#brand").val(),
								quantity : $("#quantity").val(),
								date_expire : $("#expiration").val(),
								batch : $("#batch").val(),
								desc : $("#desc").val(),
								listDesc : getListDesc(),
								variants : getVariants(),
								variantData : getVariantData(),
								active : img.data("src"),
								src : imgs,
								addProduct : true
							},
							type : "post",
							dataType : "json",
							success : function(response){
				                if(response.error.length > 0){
				                	var tpl = $("#error").html();

				                	tpl = tpl.replace("[ERROR]", response.error[0]);
				                	$(".msg").append(tpl);
					                $(".msg").removeClass("hidden");
				                } else {
				                	$(".msg").append($("#success").html());
					                $(".msg").removeClass("hidden");

				                }

							}
							, complete : function(){
				                hidePreloader();
								
							}
						});
					}
				});

				$("#reset").on("click", function(e){
					e.preventDefault();

					$("#variantBody").html("");
				});

				$("#generate").on("click", function(e){
					e.preventDefault();

					$.ajax({
						url : "ajax.php",
						data : {
							variants : getVariants(),
							generateVariants : true
						},
						type : "post",
						dataType : "json",
						success : function(response){
							console.log(response);
			                for(var i in response){
			                	var tpl = $("#variantBodyTr").html();
			                	var data = response[i];

			                	tpl = tpl.replace("[COMBO]", data);

			                	$("#variantBody").append(tpl);
			                }
						}
					});
				});

				$("#category").chosen();
				$(".chosen-container").css("width", "100%");
				var myDropzone = new Dropzone("#dropzone");

				myDropzone.on("complete", function(file) {
					$(file.previewElement).find(".dz-success-mark, .dz-error-mark,.dz-details").remove();

					var tpl = $("#tpl").html();

					tpl = tpl.replace("[SRC]", file.name).replace("[SRC]", file.name);
					$(".img.active").removeClass("active");
					$(".assets").append(tpl);

					__listen();

					file.previewElement.addEventListener("click", function() {
						+myDropzone.removeFile(file);
					});
				});
			});
		})(jQuery);
	</script>
</body>
</html>