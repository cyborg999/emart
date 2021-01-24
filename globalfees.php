<?php include "./head2.php";?>
<body>
	<div class="container">
		<div class="row">
			<br>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active = "settings"; include "./sidenav.php";?>

			</div>
			<div class="col-sm-10">
				<?php  include_once "./error.php"; ?>
				<?php
					$fees = $model->getGlobalFees();
					$deliveryFee = $model->getDeliverFee();
				?>
				<div class="content">
					<h5>Shipping Fee</h5>
					<table class="table table-sm">
						<thead>
							<tr>
								<th>Municipality</th>
								<th>Fee</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php foreach($deliveryFee as $idx => $d): ?>
							<tr>
								<td class="municipality"><?= $d['municipality'];?></td>
								<td>₱<?= number_format($d['fee'],2);?></td>
								<td>
									<a href="" data-id="<?= $d['id'];?>" class="delete btn btn-sm btn-danger"><svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#dash"/></svg> </a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<td>
									<input type="text" class="form-control" id="municipality" name="">
								</td>
								<td>
									<input type="number" class="form-control" id="fee" name="">
								</td>
								<td>
									<a href="" id="add" class="btn btn-success btn-sm"><svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg> </a>
								</td>
							</tr>
						</tfoot>
					</table>
					<form method="post">
						<h5>Default Shipping Fee</h5>
						<input type="hidden" name="feeId" value="">
						<input type="hidden" name="updateGlobalFee" value="true">
						<input type="number" value="<?= ($fees) ? $fees['shipping'] : "";?>" class="form-control" required="" placeholder="Shipping Fee" name="shipping">
						<br>
						<h5>Tax</h5>
						<input type="number" value="<?= ($fees) ? $fees['tax'] : "";?>" class="form-control" placeholder="Tax" required name="tax">
						<br>
						<h5>Minimum Purchase Total <small>(0 if no minimum)</small></h5>
						<input type="number" min="0" value="<?= ($fees) ? $fees['minimum'] : "0";?>" class="form-control" placeholder="Minimum Purchase"  required name="minimum">
						<br>
						<button class="btn btn-lg btn-primary" id="save">Save</button>
					</form>
					
				</div>


			</div>
		</div>
	</div>
	<!-- start tpl -->
	<script type="text/html" id="tpl">
		<tr>
			<td class="municipality">[MUNICIPALITY]</td>
			<td>₱[FEE]</td>
			<td>
				<a href="" data-id="[ID]" class="delete btn btn-sm btn-danger"><svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#dash"/></svg> </a>
			</td>
		</tr>
	</script>

	<!-- end tpl -->
	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				function __listen(){
					$(".delete").off().on("click", function(e){
						e.preventDefault();

						var me = $(this);

						$.ajax({
							url : "ajax.php",
							data : { deleteDeliveryFee : true, id: me.data("id")},
							type : "post",
							dataType : "json",
							success : function(response){
								me.parents("tr").remove();
							}
						});

					});
				}

				__listen();


				$("#add").on("click", function(e){
					e.preventDefault();

					var me = $(this);
					var municipality = $("#municipality");
					var fee = $("#fee");
					var tpl = $("#tpl").html();

					if(municipality.val() == "" || fee.val() == ""){
						alert("Please enter a value");

						return false;
					}

					var found = false;

					$("#tbody tr").each(function(){
						var me = $(this);
						var muni = me.find(".municipality");

						console.log(muni.html(), municipality.val());
						if(muni.html() == municipality.val()){
							alert("Municipality already exists.");

							found = true;

							return;
						}

					});

					if(found === true){
						return;
					}

					// showPreloader();

					$.ajax({
						url : "ajax.php",
						data : { addMunicipalFee : true, muni : municipality.val(), fee : fee.val()},
						type : "post",
						dataType : "json",
						success : function(id){
							tpl = tpl.replace("[MUNICIPALITY]", municipality.val()).
								replace("[ID]", id).
								replace("[FEE]", fee.val());

							$("#tbody").append(tpl);

							fee.val("");
							municipality.val("");

							__listen();
							// hidePreloader();
						}
					});

					
				});
			});
		})(jQuery);
	</script>
</body>
</html>