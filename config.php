<?php
$host = "localhost";
$dbname = "emart";
$username = "root";
$password = "";
$charset = "utf8";

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password);
