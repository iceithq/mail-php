<?php

require_once(__DIR__ . '/../vendor/autoload.php');

// $api_url = 'http://localhost:8888/iceithq/mail/api';
$api_url = 'https://mail.iceithq.com/api';
$api_key = 'YOUR_API_KEY';
$mail = new com\iceithq\Mail($api_url, $api_key);
$r = $mail->to('email@example.com')
    ->send('Test subject', 'Test body');

print_r($r);
