<?php
$host = "localhost";
$dbname = "emart";
$username = "root";
$password = "";
$charset = "utf8";

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password);

	function op($data){
		echo "<pre>";
		print_r($data);
	}

	function opd($data){
		op($data);
		die();
	}

	function opp(){
		echo "<pre>";
		print_r($_POST);
	}

	function oppd(){
		opp();
		die();
	}