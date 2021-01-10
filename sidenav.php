<?php
  //restrict acccess to page if not logged in
  if(!isset($_SESSION['id'])){
    header("Location:logout.php");
  }
  if($_SESSION['usertype'] != "merchant"){
    header("Location:logout.php");
  }
?>
<style type="text/css">
  #valid {
    font-size: 9px;
  }
</style>
<div class="profile">
  <?php $profile = $model->getUserProfile(); 
  // op($profile);

  ?>
  <style type="text/css">
    .pic2 {
      background-size: 43px; background-position: center;
    }
  </style>
	<div class="profile-pic <?= ($profile['profilePicture'] !="") ? '' : 'pic2';?>" style="background-image:url(<?= ($profile['profilePicture'] !="") ? $profile['profilePicture'] : './node_modules/bootstrap-icons/icons/image-alt.svg';?>);"></div>
	<b><?= $profile['fullname'];?></b>
	<i>Merchant</i>
</div>
<div class="accordion" id="accordionExample">

  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <a  href="dashboard.php" class="btn btn-link btn-block text-left">
        	<svg class="bi" width="15" height="15" fill="currentColor">
	<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#house-door"/></svg> 
          Dashboard
        </a>
      </h2>
    </div>
  </div>


  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <svg class="bi" width="15" height="15" fill="currentColor">
  <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#file-earmark-person"/></svg> 
          Profile
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse <?=($active =='user') ? 'show' : ''; ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="sublist">
          <li><a href="profile.php">Personal</a></li>
          <li><a href="changepassword.php">Change Password</a></li>

          <?php
            $pending = $model->checkIfPayed();
            $expiration = $model->getSubscriptionExpiration();  ?>
              <?php if(!$_SESSION['verified']): ?>
                <?php if(!$pending): ?>
                  <li><a href="activate.php">Verify Account</a></li>
                <?php endif ?>
            <?php endif ?>
        </ul>
      </div>
    </div>
  </div>

<!-- 
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        	<svg class="bi" width="15" height="15" fill="currentColor">
	<use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#shop"/></svg> 
          Store
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse <?=($active =='store') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="sublist">
        	<li>Add Product</li>
        	<li>All Products</li>
        </ul>
      </div>
    </div>
  </div>
 -->

  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <svg class="bi" width="15" height="15" fill="currentColor">
  <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#clipboard"/></svg> 
          Product
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse <?=($active =='product') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="sublist">
          <li>
            <a href="addproduct.php">Add Product</a>
          </li>
          <li>
            <a href="products.php">All Products</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
<style type="text/css">
  sup {
    color: green;
    font-weight: 900;
  }
</style>
<div class="card">
    <div class="card-header" id="headingFive">
      <h2 class="mb-0">
         <?php
          $pendingTotal = $model->getPendingOrdersByStatus("pending", true);
          $processedTotal = $model->getPendingOrdersByStatus("processed", true);
          $completedTotal = $model->getPendingOrdersByStatus("delivered", true);
          $returned = $model->getPendingOrdersByStatus("returned", true);
        ?>
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <svg class="bi" width="15" height="15" fill="currentColor">
            <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#card-checklist"/></svg> 
                    Orders <sup>(<?= $pendingTotal['total']; ?>)</sup>
                  </button>
                </h2>
              </div>
              <div id="collapseFive" class="collapse <?=($active =='order') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                 
                  <ul class="sublist">
                    <li>
                      <a href="neworder.php">Pending (<b><?= $pendingTotal['total']; ?></b>)</a>
                    </li>
                    <li>
                      <a href="processedorder.php">Processed (<b><?= $processedTotal['total']; ?></b>)</a>
                    </li>
                    <li>
                      <a href="deliveredorder.php">Delivered (<b><?= $completedTotal['total']; ?></b>)</a>
                    </li>
                     <li>
                      <a href="returnedorder.php">Returned (<?= $returned['total'];?>)</a>
                    </li>
                  </ul>
                </div>
        </div>
      </div>

     <div class="card">
        <div class="card-header" id="headingFour">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsePOS" aria-expanded="false" aria-controls="collapsePOS">
              <svg class="bi" width="15" height="15" fill="currentColor">
                <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#card-list"/></svg> POS
            </button>
          </h2>
        </div>
        <div id="collapsePOS" class="collapse <?=($active =='pos') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <ul class="sublist">
              <li>
                <a href="pos.php">View</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
       
     <div class="card">
        <div class="card-header" id="headingFour">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseReport" aria-expanded="false" aria-controls="collapseReport">
              <svg class="bi" width="15" height="15" fill="currentColor">
                <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#bar-chart-line"/></svg> Reports
            </button>
          </h2>
        </div>
        <div id="collapseReport" class="collapse <?=($active =='reports') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <ul class="sublist">
              <li>
                <a href="salesreport.php">Sales Report</a>
                <a href="inventoryreport.php">Inventory Report</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

  <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <svg class="bi" width="15" height="15" fill="currentColor">
            <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear"/></svg> 
          Settings
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse <?=($active =='settings') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="sublist">
          <li>
            <a href="store.php">Store</a>
          </li>
          <li>
            <a href="globalfees.php">Global Fee</a>
          </li>
           <li>
            <a href="shipping.php">Shipping Details</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  


</div>