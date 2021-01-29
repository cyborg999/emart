<?php include "./adminhead.php";?>
<body>
<?php include "./spinner.php";?>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<a href="index.php"><figure class="logo"></figure></a>
			</div>
			<div class="col-sm-10">
				<a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
					<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 side">
				<?php $active="footer"; include "./adminsidenav.php";?>
			</div>
			<div class="col-sm-10">
				<div class="row content">
					<div class="col-sm">
						<h5>Social Media</h5>
					</div>
				</div>
				
				<div class="row content">
					<div class="col-sm">
						<?php include_once "./error.php"; ?>
						<?php
							$socials = $model->getAllSocial();
						?>
						<br>
						<table class="table">
							<thead>
								<tr>
									<th>Social Media</th>
									<th>Link</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr id="start">
									<td>
										<input type="text" class="form-control name" name="name" required placeholder="Social Media...">
									</td>
									<td>
										<input required type="text" class="form-control link" name="link" placeholder="Link...">
									</td>
									<td>
										<input type="submit" id="add" class="btn  btn-success" value="Add">
									</td>
								</tr>
								
								<?php foreach($socials as $idx => $s): ?>
								<tr>
									<td><?= $s['social'];?></td>
									<td><a target="_blank" href="<?= $s['link'];?>"><?= $s['link'];?></a></td>
									<td>
										<a href="" data-id="<?= $s['id'];?>" class="btn btn-danger btn-sm remove">remove</a>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
	<script type="text/html" id="tpl">
		<tr>
			<td>
				[SOCIAL]
			</td>
			<td>
				<a href="[LINK]">[LINK]</a>
			</td>
			<td>
				<a href="" data-id="[ID]" class="btn btn-danger btn-sm remove">remove</a>
			</td>
		</tr>
	</script>
	<?php include "./foot.php"; ?>
	<script type="text/javascript">
		(function($){
    		function __listen(){
    			$(".remove").off().on("click", function(e){
    				e.preventDefault();

    				var me = $(this);

    				showPreloader();

    				$.ajax({
    					url  : "ajax.php",
    					data : { removeSocial: true, id : me.data("id") },
    					type : "post",
    					dataType : "json",
    					success : function(response){
							me.parents("tr").remove();

	    					hidePreloader();
    					},
    					complete : function(){
	    					hidePreloader();
    					}
    				});

    			});
    		}

    		__listen();

    		$("#add").on("click", function(e){
    			e.preventDefault();

    			var me = $(this);
    			var tr = me.parents("tr");
    			var tpl = $("#tpl").html();

    			tpl = tpl.replace("[SOCIAL]", tr.find(".name").val()).
    				replace("[LINK]", tr.find(".link").val()).
    				replace("[LINK]", tr.find(".link").val());

    			if(tr.find(".name").val() == ""){
    				alert("Please enter a social media");
    			} else {
	    			if(tr.find(".link").val() == ""){
	    				alert("Please enter a link");	
	    			} else {
	    				showPreloader();

	    				$.ajax({
	    					url  : "ajax.php",
	    					data : { addSocial: true, name : tr.find(".name").val(), link : tr.find(".link").val() },
	    					type : "post",
	    					dataType : "json",
	    					success : function(response){
	    						tpl = tpl.replace("[ID]", response.id);

		    					$("#start").after(tpl);

		    					__listen();

		    					hidePreloader();
	    					},
	    					complete : function(){
		    					hidePreloader();
		    					tr.find(".form-control").val("");
	    					}
	    				});
	    			}
    			}
    		});
    	})(jQuery);
	</script>
</body>
</html>