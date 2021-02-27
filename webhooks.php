<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '5q+j2XKHhFjFF08z8z8ffn3h+uj5jOeTE0TM5e7bE0tCa/zvSH126rFkxs7d/9PPJEmpFQP6cbtVwk9mAYoC32u9k5QKFngwX5yREA+08vhWsZT9Aa4QxmIRAKKzBI+zsHIC60K23KWG0Gh8KiYZLAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
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
			//$text = $event['source']['userId'];
			$texta = $event['message']['text'];
			if ($texta == 'order') {
				$text = 'ok';
			} else {
				$text = $event['message']['text'];
			}
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$serv = 'magichapp.ddnsfree.com:40000/api/req/';
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
			
			$pst = curl_init($serv);
			curl_setopt($pst, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($pst, CURL_RETURNTRANSFER, true);
			curl_setopt($pst, CURL_POSTFIELDS, $texta);
			curl_setopt($pst, CURL_FOLLOWLOCATION, 1);
			$resul = curl_exec($pst);
			curl_close($pst);
				
			echo $resul . "\r\n";
		}
	}
}
echo "OK";
