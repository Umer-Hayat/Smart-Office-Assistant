<?php

require_once 'vendor/autoload.php';
use Twilio\Rest\Client;



$sid = "ACde97d48a749e1275b92fe834e3ccc870";
$token = "19da7f4637c482dab592502ab517ea9e";

$client = new Client($sid, $token);

$client->messages->create(
    '+923054070950',
    array(
        'from' => '+16473605998',
        'body' => "Hand Held Technologies, This is sms for deo purpose."
    )
);