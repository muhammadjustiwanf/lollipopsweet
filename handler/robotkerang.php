<?php
/*
require_once('./line_class.php');
$channelAccessToken = 'ISI_DISINI'; //Channel access token
$channelSecret = 'ISI_DISINI';//Channel secret
*/
	$client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET']);
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

function answers(){
    $answers_list = array(
		'Ya',
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi',
		'Saya Tidak tahu'
		);
    $answr = array_rand($answers_list);
    $answrr = $list_jwb[$answr];
    return($answrr);
}

if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == '.apakah', '.bagaimana', '.kapan') {
        $balas = send(answers(), $replyToken);
    } else {}
} else {}

if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
    file_put_contents($botname.'.json',$result);
}
