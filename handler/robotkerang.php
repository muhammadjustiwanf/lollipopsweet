<?php

require_once('./line_class.php');

$client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET');
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$msg_type = $message['type'];
$botname = "robotkerangdb";

function send($input, $rt){
$send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $input
            )
        )
    );
    return($send);
}

function jawabs(){
    $list_jwb = array(
		'Ya',
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi',
		'Saya tidak tau',
		'Menurut anda?'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'apakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} else {}

if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
    file_put_contents($botname.'.json',$result);
}
