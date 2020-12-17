<?php
require_once "vendor/autoload.php";
use Omnipay\Omnipay;

$host = "localhost";
$dbname = "emart";
$username = "root";
$password = "";
$charset = "utf8";

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password);

$gateway = Omnipay::create('Stripe');
$gateway->setApiKey('sk_test_51HsSJeJmfnsrzK571DnyysUarPcyEeRilLEVowF17n6MU5aJ5Vj9VBCaEEBm5bhuPPblYs2JjdAYanLq4iQI0dfz00VN23qHFc');

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