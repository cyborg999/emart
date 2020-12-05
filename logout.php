<?php
session_start();

var_dump($_SESSION);
unset($_SESSION['id']);
unset($_SESSION['username']);

header("Location:index.php");
