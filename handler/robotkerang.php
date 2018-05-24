<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

/*
require_once('./line_class.php');
$channelAccessToken = 'ISI_DISINI'; //Channel access token
$channelSecret = 'ISI_DISINI';//Channel secret

	$replyToken = $client->parseEvents()[0]['replyToken'];
	$message 	= $client->parseEvents()[0]['message'];
	$msg_type = $message['type'];

--------------------------------------------------------------- NOTICE ME...
				
				$inputMessage = $event['message']['text'];
				$userId = $event['source']['userId'];

				if ($inputMessage[0] == '/') {

					 $inputMessage = ltrim($inputMessage, '/');
					 $inputSplit = explode(' ', $inputMessage, 2);

					 if ( function_exists( $inputSplit[0] ) ){

							$outputMessage = $inputSplit[0]( $inputSplit[1], $userId );

					 } else {
				$outputMessage = new TextMessageBuilder('Bahasa tidak dapat dimengerti.');
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

		$send = array(
				'replyToken' => $rt,
				'messages' => array(
						array(
								'type' => 'text',					
								'text' => $input
								)
				)
		);
		return $send;
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
		return $answrr;
}

		if($msg_type == 'text'){
				$pesan_datang = strtolower($message['text']);
				$filter = explode(' ', $pesan_datang);
						if($filter[0] == '.apakah', '.bagaimana', '.kapan') {
								if ($filter == null){
										$result = new TextMessageBuilder('Jangan typo atuh, gak bot jawab nanti :v');
				} else {
        $result = send(answers(), $pesan_datang);
		} else {}
} else {}

return $result;
file_put_contents($botname.'.json',$result);

}
/*
if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
*/
