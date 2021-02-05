
    <?php include_once "./head4.php"; ?>
    <?php include_once "./headnew.php"; ?>
    <?php include_once "./spinner.php"; ?>
    <main>
		<div class="container-fluid">
			<div class="container">
				<br>
			
				<div class="row">
					<div class="col-sm">
						<?php if(isset($_SESSION['id'])) : ?>
	                       <article class="card" style="display: block;margin: 0 auto;">
								<header class="card-header"> My wishlist </header>
								<div class="card-body">

									<div class="row">
										<?php
											$wishlist = $model->getWishlistProducts();
										?>
											
											<?php foreach($wishlist as $idx => $w): ?>
											<div class="col-md-4">
												<figure class="itemside mb-4">
													<div class="aside"><img src="./uploads/merchant/<?= $w['storeid'];?>/<?= $w['id'];?>/<?= $w['filename'];?>" class="border img-md"></div>
													<figcaption class="info">
														<a href="#" class="title"><?= $w['name'];?></a>
														<p class="price mb-2">₱<?= number_format($w['price'],2);?></p>
														<a href="productdetail.php?id=<?= $w['id'];?>" class="btn btn-primary btn-sm"> View Item </a>
														<a href="#" class="btn btn-danger btn-sm remove" data-toggle="tooltip" title="" data-id="<?= $w['id'];?>" data-original-title="Remove from wishlist"> <i class="fa fa-times"></i> </a>
													</figcaption>
												</figure>
											</div> <!-- col.// -->
											<?php endforeach ?>
									</div> <!-- row .//  -->
								</div> <!-- card-body.// -->
							</article>
						<?php else : ?>
							<div class="col-sm">
								<p>Please <a href="login.php" class="link">login</a> first to view this page.</p>
							</div>

						<?php endif ?>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
		</div>
    <?php include "./newfooter.php"; ?>
	</main>
	<script type="text/javascript">
		(function($){
			$(".remove").on("click", function(e){
				e.preventDefault();

				var me = $(this);
				var id = me.data("id");

				showPreloader();

				$.ajax({
					url  : "ajax.php",
					data : { deleteWishlist : true, id : id},
					type : "post",
					dataType : "json",
					success : function(response){
                        $("#wishListcount").html(response.wishlist.length);

                        me.parents(".col-md-4").remove();
					},
					complete : function(){
						hidePreloader();
					}
				});
			});
		})(jQuery);
	</script>
</body>
</html>