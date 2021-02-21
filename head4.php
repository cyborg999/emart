<?php 
if(isset($_POST['REDIRECT'])){
    header("Location: success.php");
}
    include_once "./model.php";

    $model = new Model();
    $err = $model->getErrors();
  // $logo = $model->getLogo();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>eMart</title>

	<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
	<meta name="description" content="ui library for front-end developers to create online shor templates">
	<meta name="keywords" content="ui kit, ecommerce templates, website, e-commerce, uikit framework, HTML, CSS, Bootstrap 4">
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

	<!-- Bootstrap-ecommerce -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >

	<!-- <link rel="stylesheet" type="text/css" href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/bootstrap.css?v=2.0"> -->
	<link href="./css/ui.css?v=2.0" rel="stylesheet" type="text/css">
	<!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/ui.css?v=2.0" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.css" >
	<!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/css/responsive.css?v=2.0" rel="stylesheet"> -->

	<!-- fonticon -->
	<!-- <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/fonts/fontawesome/css/all.min.css?v=2.0" type="text/css" rel="stylesheet"> -->

	<!-- Custom styling -->
	<link href="./css/style.css?v=2.0" rel="stylesheet">
	<!-- <link href="https://bootstrap-ecommerce.com/assets/css/style.css?v=2.0" rel="stylesheet"> -->
			<!-- Animate Css -->
       
        <link rel="stylesheet" href="./index_files/style.css">
</head>
<body>
	<style type="text/css">
		.container-fluid {
			padding: 0;
			margin: 0 auto;
		}
		header {
			box-shadow: 1px 1px 10px #c9c9c9;
		}
		footer {
			background: white;
		}
	</style>