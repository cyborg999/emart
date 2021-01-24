<?php 
	include_once "./model.php";

	$model = new Model();
	$err = $model->getErrors();
  $logo = $model->getLogo();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="./node_modules/chart.js/dist/Chart.min.css">



    <link rel="stylesheet" href="./node_modules/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="./node_modules/chosen-js/chosen.min.css" >
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.css" >
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <script src="./node_modules/dropzone/dist/min/dropzone.min.js"></script>
    <title>eMart</title>
  </head>
<body>

  <style type="text/css">
/*@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");*/
/*@import url("./css/fa.css");*/

.navbar-icon-top .navbar-nav .nav-link > .fa {
position: relative;
width: 36px;
font-size: 24px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
font-size: 0.75rem;
position: absolute;
right: 0;
font-family: sans-serif;
}

.navbar-icon-top .navbar-nav .nav-link > .fa {
top: 3px;
line-height: 12px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
top: -10px;
}

@media (min-width: 576px) {
.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 768px) {
.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 992px) {
.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 1200px) {
.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

    </style>

<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">eMart</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse contsainer" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
     
    </ul>
    <ul class="navbar-nav " style="padding-right:60px;">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fa fa-home"></i>
          <span class="sr-only">(current)</span>
          </a>
      </li>
    <!--   <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fa fa-envelope-o">
            <span class="badge badge-danger">11</span>
          </i>
        </a>
      </li> -->
      <?php
        $review = $model->getNotificationsByType("UserReview");
        $order = $model->getNotificationsByType("Order");
      ?>
      <li class="nav-item">
        <a class="nav-link" href="notifications.php?type=order">
          <i class="fa fa-bell">
            <span class="badge badge-info"><?= count($order);?></span>
          </i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="notifications.php?type=UserReview">
          <i class="fa fa-globe">
            <span class="badge badge-success"><?= count($review);?></span>
          </i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-gears">
          </i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile.php">Profile</a>
          <a class="dropdown-item" href="store.php">Store</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      <li class="nav-item dropdown"></li>
    </ul>
  </div>
</nav>
<style type="text/css">
  .navbar-expand-lg .navbar-nav .dropdown-menu {
    left: initial;
    right: 20px!important;
  }
</style>