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
									<br>
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
	<!-- end tpl scripts -->

	<?php include "./foot.php"; ?>
	<script src="./node_modules/chosen-js/chosen.jquery.min.js" ></script>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$("#addNewBatch").on("submit", function(e){
					e.preventDefault();

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
					$(".img").off().on("click", function(){
						var me = $(this);

						$(".img.active").removeClass("active");
						me.addClass("active");
					});
				}

				__listen();

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

				                hidePreloader();
							}
						});
					}
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