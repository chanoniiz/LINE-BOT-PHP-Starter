<?php
//include 'TestMqtt.php';
$access_token = 'I10FeTUvizhulrxBQp4WTsRurtLiAvaLaASuEbK9/YU/zGV9BcPDMrrn28QBTD6Wh4ZL0BFSBQKTli+zaxY7zEdBb3u1xRu+6l8i9qt8leRllyTHUO+tNsXDz/Enq0DuC2muj7WvcseFkGTPFFTJdAdB04t89/1O/w1cDnyilFU=';
// Get POST body 
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// set value new ;
			$senderID = $event['replyToken'];
			$threadID = $event['userId'];
			$form = "line";
			
			$myObj->$senderID;
			$myObj->$threadID;
			$myObj->$text;
			$myObj->$form;
			
			//$data_json = $senderID.$threadID.$text.$form ;
			$data_json = json_encode($myObj);
			
			//set jsondata to http  server 
			$jsondata = file_get_contents('http://202.28.37.32/smartcsmju/project_class/LineAPI/Bot.php?msg='.$data_json);
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $data_json
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
			
			
			
		}
	}
}
echo "OK";
