<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

/*
--------------------------------------------------------------- NOTICE ME...
				
				$inputMessage = $event['message']['text'];
				$userId = $event['source']['userId'];

				if ($inputMessage[0] == '/') {

					 $inputMessage = ltrim($inputMessage, '/');
					 $inputSplit = explode(' ', $inputMessage, 2);

					 if ( function_exists( $inputSplit[0] ) ){

							$outputMessage = $inputSplit[0]( $inputSplit[1], $userId );

					 } else {
				$outputMessage = new TextMessageBuilder("tipe command tidak ditemukan, coba kakak ketik:\n\n.help\n\nbiar kakak tau apa aja commandnya :v");
					 }
				
				$result = $bot->replyMessage($event['replyToken'], $outputMessage);
				return $result->getHTTPStatus() . ' ' . $result->getRawBody();

} else {

				$wordsLearned = file_get_contents('https://bot-line-multifunction.firebaseio.com/words.json');
				$wordsLearned = json_decode($wordsLearned, true);

				foreach ($wordsLearned as $word => $answer) {
						if (strpos(strtolower($inputMessage), $word) !== false) {
								$outputMessage = new TextMessageBuilder($answer);
								$result = $bot->replyMessage($event['replyToken'], $outputMessage);
								return $result->getHTTPStatus() . ' ' . $result->getRawBody();
								break;
						}
				}

}
				
				// --------------------------------------------------------------- ...SENPAI!
*/

$botname = "robotkerangdb";

function send($input, $rt){
if ($input == null){
$result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu..... :v\n\nCara menggunakannya:\nKetik: /apakah kata2 yang ingin diajukan.\n\nContoh: /apakah bot pintar?\n\nSelamat mencoba :v");
} else {
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
    if($input[0] == 'apakah') {
        $result = new TextMessageBuilder(send(answers(), rand($answerslist));
    } else {}
} else {}

return $result;

file_put_contents($botname.'.json',$result);

/*
if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
}
*/