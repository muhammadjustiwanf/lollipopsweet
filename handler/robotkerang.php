<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function apakah($inputMessage, $event){
if ($inputMessage == null){
$result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu..... :v\n\nCara menggunakannya:\nKetik: /apakah kata2 yang ingin diajukan.\n\nContoh: /apakah bot pintar?\n\nSelamat mencoba :v");
} else {
 $result = array, new TextMessageBuilder($inputMessage);
}
return $result;
}

function aswers(){
    $aswerslist = array(
		'Ya',
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi'
		);
    $answr = array_rand($answerslist);
    $answrr = $answerslist[$answr];
    return($answrr);
}

if(strtolower($inputMessage)){
    $inputMessage = explode(' ', $inputMessage);
    $balas = apakah(answers(), $replyToken);
    $result = new TextMessageBuilder($balas);
}
return $result;
}

file_put_contents($botname.'.json',$result);

/*
if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
}
*/