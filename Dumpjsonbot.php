<?php
include 'TestMqtt.php';
$access_token = 'I10FeTUvizhulrxBQp4WTsRurtLiAvaLaASuEbK9/YU/zGV9BcPDMrrn28QBTD6Wh4ZL0BFSBQKTli+zaxY7zEdBb3u1xRu+6l8i9qt8leRllyTHUO+tNsXDz/Enq0DuC2muj7WvcseFkGTPFFTJdAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
$data = var_dump($events);

$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";



?>
