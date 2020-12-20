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
  .profile-pic {
    /*  background: url(./node_modules/bootstrap-icons/icons/person.svg);
      background-size: contain;*/
  }
</style>
<div class="profile">
	<div class="profile-pic"></div>
  <?php $profile = $model->getUserProfile(); ?>
	<b><?= $profile['fullname'];?></b>
	<i>Merchant</i>
</div>
<div class="accordion" id="accordionExample">

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

<div class="card">
    <div class="card-header" id="headingFive">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <svg class="bi" width="15" height="15" fill="currentColor">
            <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear"/></svg> 
                    Orders
                  </button>
                </h2>
              </div>
              <div id="collapseFive" class="collapse <?=($active =='order') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <ul class="sublist">
                    <li>
                      <a href="globalfees.php">New</a>
                    </li>
                     <li>
                      <a href="globalfees.php">Pending</a>
                    </li>
                    <li>
                      <a href="globalfees.php">Completed</a>
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