<?php
/**
    npm install twilio-cli -g
    twilio login
    sadiwajordan1991@gmail.com 
    aaaaaa (14 na a)
    https://www.twilio.com/console
*/
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC46796572fe8954fedd1546cd9d4e5a17';
$auth_token = 'af73690651a854d0055cf389d1b8e83f';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+15017122661";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+15558675310',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);
