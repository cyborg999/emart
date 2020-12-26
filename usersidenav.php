<style type="text/css">
  .profile-pic {
    /*  background: url(./node_modules/bootstrap-icons/icons/person.svg);
      background-size: contain;*/
  }
</style>
<div class="profile">
  <?php $profile = $model->getUserProfile(); ?>
<style type="text/css">
    .pic2 {
      background-size: 43px; background-position: center;
    }
  </style>
  <div class="profile-pic <?= ($profile['profilePicture'] !="") ? '' : 'pic2';?>" style="background-image:url(<?= ($profile['profilePicture'] !="") ? $profile['profilePicture'] : './node_modules/bootstrap-icons/icons/image-alt.svg';?>);"></div>
  
	<b><?= $profile['fullname'];?></b>
	<i>Customer</i>
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
        	<li><a href="userprofile.php">Personal</a></li>
        	<li><a href="userchangepassword.php">Change Password</a></li>
        </ul>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <svg class="bi" width="15" height="15" fill="currentColor">
  <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#clipboard"/></svg> 
          Order
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse <?=($active =='order') ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <?php
          $pending = $model->getTransactionByStatus("pending", true);
          $completed = $model->getTransactionByStatus("completed", true);

        ?>
        <ul class="sublist">
          <li>
            <a href="pending.php">Pending (<?= $pending['total'];?>)</a>
          </li>
          <li>
            <a href="completed.php">Completed (<?= $completed['total'];?>)</a>
          </li>
        </ul>
      </div>
    </div>
  </div>




</div>