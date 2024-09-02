<?php

//use Snipworks\Smtp\Email;

include_once('Email.php');
 	
$host = "e-portail.alsalamalgeria.com";
$port = 25;
$username = "gateway@e-portail.alsalamalgeria.com";
$password = "Hdn75p2?Ret7_k31iHu2s1#3";


$from = "gateway@e-portail.alsalamalgeria.com";
$to = "nouashakim@gmail.com";
$to = "hakimnouas@hotmail.com";

$mail = new Email($host, $port);
$mail->setLogin($username, $password)
    ->setFrom($from )
    ->setSubject('Sujet')
    ->setTextMessage('Plain text message')
    ->setHtmlMessage('<strong>HTML  Message Pour Tester</strong>')
    ->addTo($to)
    ->addAttachment(dirname(__DIR__) . '/LICENSE')
    ->addAttachment(dirname(__DIR__) . '/README.md');

if ($mail->send()) {
    echo 'Message Envoye a ' .$to . PHP_EOL;
    exit(0);
}

echo 'An error has occurred. Please check the logs below:'."<br>" . PHP_EOL;
$logs = implode("<br>", $mail->getLogs());
print_r($logs);
