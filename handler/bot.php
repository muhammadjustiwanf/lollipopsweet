<?php

$client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET']);
$userId = $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp = $client->parseEvents()[0]['timestamp'];
$type = $client->parseEvents()[0]['type'];
$message = $client->parseEvents()[0]['message'];
$messageid = $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = $message['text'];
$msg_type = $message['type'];
