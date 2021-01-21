<?php 
$products = "";

if(isset($_GET['category'])){
  $products = $model->getProductByCategoryId($_GET['category']);
} elseif(isset($_POST['search'])) {
  $products = $model->getProductByName($_POST['search']);
} else {
  $products = $model->getAllPublicProducts();
}

?>
 <style type="text/css">
      .products {
          display: flex;
          flex-direction: row;
          justify-content: space-around;
      }
     .product {
      display: block;
      width: 32%;
      position: relative;
      margin-bottom: 10px;
      background: #f6f6f6;
      padding: 0;
      margin: 5px 0px 10px;
      box-sizing: border-box;
     }
     .product .img {
      height: auto;
      max-height: 250px;
      display: block;
      margin: 0 auto;
     }
     .product .content {
      position: absolute;
      display: none;
      width: 100%;
      height: 100%;
      bottom: 0;
      left: 0;
      background: rgba(0,0,0,.5);
     }
     .product:hover .content {
      display: block;
     }
     a.view {
      padding: 6px 0;
      color: white;
      text-decoration: none;
      border: 0;
      border-radius: 5px;
      font-size: 20px;
      text-transform: uppercase;
      font-weight: 600;
      text-align: center;
      background: #5677fc;
      display: block;
      width: 200px;
      margin: 42% auto 0;
     }
     .bottom-content {
      display: flex;
      flex-direction: column;
      justify-content: space-around;
      padding: 5px;
      box-sizing: border-box;
      background: white;
      margin-bottom: 0px;
     }
     .bottom-content h4 {
          display: block;
          position: relative;
          overflow: hidden;
          line-height: 1;
          font-size: 18px;
          margin: 0;
          font-size: 20px;
     }
     .bottom-content em {
          font-size: 18px;
          font-style: normal;
          font-weight: 600;
          color: #5677fc;
          margin: 0;
          line-height: 1;
     }
     .slider-area .menu-widget ul li a {
      text-decoration: none;
     }
 </style>
 <?php if(!count($products)): ?>
    <h5>No product found.</h5>
 <?php endif ?>
 <?php foreach($products as $idx => $p): ?>
  <div class="product">
      <img class="img" src="./uploads/merchant/<?= $p['storeid'];?>/<?= $p['id'];?>/<?= $p['filename'];?>"/>
      <div class="content">
          <a href="productdetail.php?id=<?= $p['id'];?>" class="view">View Product</a>
      </div>
      <div class="bottom-content">
          <em><?= $p['name'];?></em>
          <h4>₱<?= number_format($p['price'],2);?></h4>
      </div>
  </div>
 <?php endforeach ?>