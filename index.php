<?php

require 'line_class.php';
require 'vendor/autoload.php';
include 'unirest-php-master/src/Unirest.php';

use LINE\LINEBot\SignatureValidator as SignatureValidator;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
foreach (glob("handler/*.php") as $handler){
		if ($handler != 'handler/post.php'){
				include $handler;
		}
}

$dotenv = new Dotenv\Dotenv('env');
$dotenv->load();

$configs =  [
	'settings' => ['displayErrorDetails' => true],
];
$app = new Slim\App($configs);

$app->get('/', function ($request, $response) {
	return "Sukses mendeploy. Silahkan dicoba botnya";
});

$app->post('/', function ($request, $response)
{
	$body 	   = file_get_contents('php://input');
	$signature = $_SERVER['HTTP_X_LINE_SIGNATURE'];
	file_put_contents('php://stderr', 'Body: '.$body);
	
	if (empty($signature)){
		return $response->withStatus(400, 'Signature not set');
	}
	
	if($_ENV['PASS_SIGNATURE'] == false && ! SignatureValidator::validateSignature($body, $_ENV['CHANNEL_SECRET'], $signature)){
		return $response->withStatus(400, 'Invalid signature');
	}
	
	$client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET']);
	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV['CHANNEL_ACCESS_TOKEN']);
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $_ENV['CHANNEL_SECRET']]);

	$data = json_decode($body, true);
	foreach ($data['events'] as $event)
	{
		if ($event['type'] == 'message')
		{

			$userId = $client->parseEvents()[0]['source']['userId'];
			$replyToken = $client->parseEvents()[0]['replyToken'];
			$timestamp	= $client->parseEvents()[0]['timestamp'];
			$type = $client->parseEvents()[0]['type'];
			$message 	= $client->parseEvents()[0]['message'];
			$messageid = $client->parseEvents()[0]['message']['id'];
			$profil = $client->profil($userId);
		 
		 if ($message['type'] == 'sticker'){
			 
			 $reply = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => $profil->displayName . ', Stikernya keren 😎'										
									
									)
							)
						);

		$client->replyMessage($reply);
						
}

$pesan_datang = explode(" ", $message['text']);
$msg_type = $message['type'];
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[Function]-------------------------#
function ytsearch($keyword) {
    $uri = "http://rahandiapi.herokuapp.com/youtubeapi/search?key=betakey&q=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Channel : ";
	$result .= $json['result']['author'];
	$result .= "\nJudul : ";
	$result .= $json['result']['title'];
	$result .= "\nDurasi : ";
	$result .= $json['result']['duration'];
	$result .= "\nLikes : ";
	$result .= $json['result']['likes'];
	$result .= "\nDislike : ";
	$result .= $json['result']['dislikes'];
	$result .= "\nPenonton : ";
	$result .= $json['result']['viewcount'];
	$result .= "\nLink Thumbnail : ";
	$result .= $json['result']['thumbnail'];
    return $result;
}

if($message['type']=='text') {
	    if ($command == '/ytsearch') {
        $hasil = ytsearch($options);
        $hasill = thumbnail($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => $hasil
                ), array(
                    'type' => 'image',
                    'originalContentUrl' => $hasill,
                    'previewImageUrl' => $hasill
                )
            )
        );
    }
}
		$client->replyMessage($balas);

			if ($event['message']['type'] == 'text')
			{
				
				// --------------------------------------------------------------- NOTICE ME...
				
				$inputMessage = $event['message']['text'];

				if ($inputMessage[0] == '.') {

					 $inputMessage = ltrim($inputMessage, '.');
					 $inputSplit = explode(' ', $inputMessage, 2);

					 if ( function_exists( $inputSplit[0] ) ){

							$outputMessage = $inputSplit[0]( $inputSplit[1], $userId );

					 } else {
				$outputMessage = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Maaf ' . $profil->displayName . ', tipe command yang anda input tidak ditemukan.'										
									
									)
							)
						);
					 }
				
				$client->replyMessage($outputMessage);
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
				
			}
		}
	}

});

$app->run();