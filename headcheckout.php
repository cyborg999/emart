    <?php 
  include_once "./model.php";
  $model = new Model();

    require "vendor/autoload.php";
    use Omnipay\Omnipay;
    $host = "localhost";
    $dbname = "emart";
    $username = "root";
    $password = "";
    $charset = "utf8";

    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $username, $password);
    ?>
    <?php
      if(!isset($_SESSION['cart'])){
        header("Location:login.php");
      }
      if(!isset($_SESSION['id'])){
        header("Location:login.php");
      }

                          // opd($_SESSION['cart']);

    ?>
