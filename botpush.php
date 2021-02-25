<?php



require "vendor/autoload.php";

$access_token = '5q+j2XKHhFjFF08z8z8ffn3h+uj5jOeTE0TM5e7bE0tCa/zvSH126rFkxs7d/9PPJEmpFQP6cbtVwk9mAYoC32u9k5QKFngwX5yREA+08vhWsZT9Aa4QxmIRAKKzBI+zsHIC60K23KWG0Gh8KiYZLAdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'fad822bb93ff1cd80ba458a1dcc8c31b';

$pushID = 'Ucf28931585fe9eeab10db9a99e860c8d';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







