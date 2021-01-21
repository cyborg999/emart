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
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <link rel="stylesheet" type="text/css" href="./node_modules/chart.js/dist/Chart.min.css">



    <link rel="stylesheet" href="./node_modules/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="./node_modules/chosen-js/chosen.min.css" >
    <script src="./node_modules/dropzone/dist/min/dropzone.min.js"></script>
    <title>eMart</title>
  </head>
<body>