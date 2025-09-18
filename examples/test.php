<?php

require_once(__DIR__ . '/../vendor/autoload.php');

// $api_url = 'http://localhost:8888/iceithq/mail/api';
$api_url = 'https://mail.iceithq.com/api';
$mail = new com\iceithq\Mail($api_url);
$r = $mail->to('ian.escarro@gmail.com')
    ->send('Test subject', 'Test body');

print_r($r);
