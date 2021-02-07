<?php 
$search = "";
$products = "";

if(isset($_GET['category'])){
  $products = $model->getProductByCategoryId($_GET['category']);
} elseif(isset($_POST['search'])) {
  $products = $model->getProductByName($_POST['search']);
  $search = $_POST['search'];
} elseif(isset($_GET['name'])) {
  $products = $model->getProductByCategoryName($_GET['name']);
  $search = $_GET['name'];
} elseif(isset($_GET['brand'])) {
  $products = $model->getProductByBrand($_GET['brand']);
  $search = $_GET['brand'];
} else {
  $products = $model->getAllPublicProducts();
}

?>
 <style type="text/css">
 .img {
      display: block;
      margin: 0 auto;
      height: 100%;
    background-size: cover;
    width: auto;
    background-position: center;
     }
 </style>
 <div class="row" style="padding-top: 50px;">
   <div class="col-sm">
    <?php if($search !=""): ?>
     <h5>Looking for <i><b>"<?= $search;?>"</b></i></h5>
     <br>
   <?php endif ?>
   </div>
 </div>
 <div class="row" style="min-height: 500px;padding: 0px 0 50px;">
   <?php if(!count($products)): ?>
    <div class="col-sm" >
      <h5>No product found.</h5>
    </div>
   <?php endif ?>
   <?php foreach($products as $idx => $p): ?>
    <div class="col-md-3">
      <figure class="card card-product-grid">
        <a href="productdetail.php?id=<?= $p['id'];?>" class="img-wrap"> 
          <figure class="img" style="background:url(./uploads/merchant/<?= $p['storeid'];?>/<?= $p['id'];?>/<?= $p['filename'];?>) no-repeat;background-size: cover; background-position: center; padding: 0; margin: 0; width: auto;"></figure>
          <!-- <img class="img" src="./uploads/merchant/<?= $p['storeid'];?>/<?= $p['id'];?>/<?= $p['filename'];?>"> -->
        </a>
        <figcaption class="info-wrap">
          <a href="#" class="title"><?= $p['name'];?></a>
          <div class="mt-2">
            <var class="price">₱<?= number_format($p['price'],2);?></var> <!-- price-wrap.// -->
            <a href="productdetail.php?id=<?= $p['id'];?>" class="view btn btn-sm btn-outline-primary float-right">View Product </a>
          </div> <!-- action-wrap.end -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col.// -->
   <?php endforeach ?>   
 </div>

<!-- 
   <div class="product">
      <img class="img" src="./uploads/merchant/<?= $p['storeid'];?>/<?= $p['id'];?>/<?= $p['filename'];?>"/>
      <div class="content">
          <a href="productdetail.php?id=<?= $p['id'];?>" class="view btn btn-sm btn-outline-primary float-right">View Product <i class="fa fa-shopping-cart"></a>
      </div>
      <div class="bottom-content">
          <em><?= $p['name'];?></em>
          <h4>₱<?= number_format($p['price'],2);?></h4>
      </div>
  </div> -->