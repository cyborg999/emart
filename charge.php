<?php
require_once "config.php";
session_start();

if (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) {
 
    try {
        $token = $_POST['stripeToken'];
     
        $response = $gateway->purchase([
            'amount' => $_POST['amount'],
            'currency' => 'PHP',
            'token' => $token,
        ])->send();
     
        if ($response->isSuccessful()) {
            // payment was successful: update database
            $arr_payment_data = $response->getData();
            $payment_id = $arr_payment_data['id'];
            $amount = $_POST['amount'];
 
            // Insert transaction data into the database
            $isPaymentExist = $db->query("SELECT * FROM payments WHERE payment_id = '".$payment_id."'")->fetch();

            if(!$isPaymentExist) { 
                $sql = "INSERT INTO payments(payment_id, amount, currency, payment_status,userid) VALUES(?,?,?,?,?)
                ";

                $db->prepare($sql)->execute(array($payment_id, $amount, 'PHP', 'Captured', $_SESSION['id']));

               //add transaction
                $sql = "
                    INSERT INTO transaction(userid,total)
                    VALUES(?,?)
                ";

                $db->prepare($sql)->execute(array($_SESSION['id'], $_SESSION['cart']['total']));

                $transactionId = $db->lastInsertId();

                //add cart detail
                $sql = "
                    INSERT INTO cart_details(transactionid,userid,firstname,lastname,address,contact,email,instruction,total,tax_total,grand_total,shipping_total)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)
                ";

                $db->prepare($sql)->execute(array($transactionId,$_SESSION['id'],$_POST['firstname'],$_POST['lastname'],$_POST['address'],$_POST['contact'],$_POST['email'],$_SESSION['cart']['instruction'],$_SESSION['cart']['total'],$_SESSION['cart']['taxTotal'],$_SESSION['cart']['grandTotal'],$_SESSION['cart']['shippingTotal']));

                //add cart products
                if(isset($_SESSION['cart']['products'])){
                    foreach($_SESSION['cart']['products'] as $idx => $p){
                        $sql = "
                            INSERT INTO cart(userid,productid,price,quantity,shipping,tax,transactionid)
                            VALUES(?,?,?,?,?,?,?)   
                        ";          
                        $db->prepare($sql)->execute(array($_SESSION['id'],$p['productId'],$p['detail']['price'],$p['detail']['quantity'],$p['detail']['shipping'],$p['detail']['tax'], $transactionId));
                    }

                }
            } 
            
            header("Location:success.php");
        } else {
            // payment failed: display message to customer
            echo ' <div class="alert alert-danger" role="alert">'.$response->getMessage().'</div>';
        }
    } catch(Exception $e) {
            echo ' <div class="alert alert-danger" role="alert">'.$response->getMessage().'</div>';
    }
}