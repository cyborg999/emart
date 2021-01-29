<div class="profile">
  <?php $profile = $model->getUserProfile(); ?>
<style type="text/css">
    .pic2 {
      background-size: 43px; background-position: center;
    }
  </style>
  <div class="profile-pic <?= ($profile['profilePicture'] !="") ? '' : 'pic2';?>" style="background-image:url(<?= ($profile['profilePicture'] !="") ? $profile['profilePicture'] : './node_modules/bootstrap-icons/icons/image-alt.svg';?>);"></div>
  
	<b><?= $_SESSION['username'] ?></b>
	<i>Admin</i>
</div>
	<div class="accordion" id="accordionExample">
				  <div class="card ">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
				          <svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#file-person"/></svg> Profile
				        </button>
				      </h2>
				    </div>
				    <div id="collapseProfile" class="<?= ($active == "user") ? "show" : ""; ?> collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
				       <ul class="list-group list-group-flush">
				         <li class="list-group-item"><a href="adminprofile.php">Edit Profile</a></li>
				         <li class="list-group-item"><a href="adminchangepassword.php">Change Password</a></li>
				     	</ul>
				      </div>
				    </div>
				  </div>

				    <div class="card hidden">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
				           <svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#bell"/></svg> Notifications
				        </button>
				      </h2>
				    </div>

				    <div id="collapseZero" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
				        TODO 
				      </div>
				    </div>
				  </div>


			   

		<!-- 		  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#ccollapseOne" aria-expanded="true" aria-controls="ccollapseOne">
				          <svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#clipboard-plus"/></svg> Subscription
				        </button>
				      </h2>
				    </div>

				    <div id="ccollapseOne" class="<?= ($active == "sub") ? "show" : ""; ?> collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
				      	<ul class="list-group list-group-flush">
						  <li class="list-group-item">
						  	<a href="plan.php" class="black">Plan</a>
						  </li>
						</ul>
				      </div>
				    </div>
				  </div> -->

				  
				 <div class="card">
					<div class="card-header" id="collapseFooter">
					  <h2 class="mb-0">
					    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFooterb" aria-expanded="true" aria-controls="collapseFooterb">
					      <svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#clipboard-plus"/></svg> Footer
					    </button>
					  </h2>
					</div>

					<div id="collapseFooterb" class="<?= ($active == "footer") ? "show" : ""; ?> collapse" aria-labelledby="collapseFooter" data-parent="#accordionExample">
					  <div class="card-body">
					  	<ul class="list-group list-group-flush">
						  <li class="list-group-item">
						  	<a href="terms.php" class="black">Terms & Conditions</a>
						  </li>
						   <li class="list-group-item">
						  	<a href="privacy.php" class="black">Privacy & Policy</a>
						  </li>
						  <li class="list-group-item">
						  	<a href="contact.php" class="black">Contact Us</a>
						  </li>
						  <li class="list-group-item">
						  	<a href="about.php" class="black">About Us</a>
						  </li>
						  <li class="list-group-item">
						  	<a href="overview.php" class="black">Overview</a>
						  </li>
						  <li class="list-group-item">
						  	<a href="socialmedia.php" class="black">Social Media</a>
						  </li>
						</ul>
					  </div>
					</div>
				</div>

				  <div class="card">
				    <div class="card-header" id="headingTwo">
				      <h2 class="mb-0">
				        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          <svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear"/></svg> Settings
				        </button>
				      </h2>
				    </div>
				    <div id="collapseTwo" class="<?= ($active == "settings") ? "show" : ""; ?> collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				      <div class="card-body">
				      	<ul class="list-group list-group-flush">
				      <!--    <li class="list-group-item">
						  	<a href="slideshow.php" class="black">Add Slide</a>
						  </li>
						   <li class="list-group-item">
						  	<a href="slideshows.php" class="black">All Slides</a>
						  </li> -->
						  <li class="list-group-item">
						  	<a href="categories.php" class="black">Categories</a>
						  </li>
						  <li class="list-group-item">
						  	<a href="plan.php" class="black">Subscription</a>
						  </li>
						<!--    <li class="list-group-item">
						  	<a href="addnews.php" class="black">Add News</a>
						  </li>
						   <li class="list-group-item">
						  	<a href="news.php" class="black">All News</a>
						  </li> -->
						<!--   <li class="list-group-item">
						  	<a href="logo.php" class="black">Logo</a>
						  </li> -->
						</ul>
				      </div>
				    </div>
				  </div>
				 
				</div>