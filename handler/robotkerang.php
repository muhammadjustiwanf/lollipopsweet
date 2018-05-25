<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function send($input){
if ($input == null){
$result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu..... :v\n\nCara menggunakannya:\nKetik: /apakah kata2 yang ingin diajukan.\n\nContoh: /apakah bot pintar?\n\nSelamat mencoba :v");
} else {
$result = new TextMessageBuilder($input);
/*
    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $input
            )
        )
    );
*/
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

if(strtolower($inputMessage){
    $input = explode(' ', $inputMessage);
    if($input[0] == 'apakah'){
        $balas = send(answers());
        $result = new TextMessageBuilder(json_encode, $balas);
    }
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