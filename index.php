<?php

require 'vendor/autoload.php';
require 'line_class.php';
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
		 
if($message['type']=='text') {
	    if ($command == 'Hi' || $command == 'Hallo' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'HALLO '.$profil->displayName
                )
            )
        );
    }
} else if ($command == '.bantuan'){

	        $balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array (
										  'type' => 'template',
										  'altText' => 'Silahkan pilih keyword yang kamu inginkan',
										  'template' => 
										  array (
										    'type' => 'carousel',
										    'columns' => 
										    array (
										      0 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 1',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Anime',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /anime [Judul Anime]'
										          ),
										          1 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Sinopsis Anime',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /anime-syn [Judul Anime]'
												  ),
										          2 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Manga',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /manga [Judul Manga]'
										          ),
										        ),
										      ),
										      1 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 2',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Sinopsis Manga',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /manga-syn [Judul Manga]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Film',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /film [Judul Film]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Sinopsis Film',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /film-syn [Judul Film]'
										          ),
										        ),
										      ),
										      2 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 3',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Aplikasi',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /playstore [Nama Aplikasi]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Informasi',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /myinfo'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Zodiak',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /zodiak [Tanggal Lahir]'
										          ),
										        ),
										      ),
										      3 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 4',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Music',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /music [Judul Lagu]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Lirik',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /lirik [Judul Lagu]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Waktu',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /time [Nama Kota]'
										          ),
										        ),
										      ),
										      4 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 5',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Lokasi',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /lokasi [Nama Kota]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Kalender',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /kalender [Nama Kota]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari KosaKata',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /def [Kata]'
										          ),
										        ),
										      ),
										      5 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 6',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Qiblat',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /qiblat [Nama Kota]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Jadwal Shalat',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /shalat [Nama Kota]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Cuaca',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /cuaca [Nama Kota]'
										          ),
										        ),
										      ),
										      6 => 
										      array (
										        'thumbnailImageUrl' => 'https://raw.githubusercontent.com/muhammadjustiwanf/lollipopsweet/master/pict.png',
										        'title' => 'Keyword 7',
										        'text' => 'Silahkan Dipilih',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Convert',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /convert [Link]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'About',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /about'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Creator',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /translate'
										          ),
										        ),
										      ),											  
										    ),
										  ),
										)					
			 
        )
    );

  $client->replyMessage($balas);

	} else

		 if ($message['type'] == 'sticker'){
			 
			 $result = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => $profil->displayName . ', Stikernya keren 😎'										
									
									)
							)
						);

		$client->replyMessage($result);

}

			if($event['message']['type'] == 'text')
			{
				/*
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
				*/
			}
		}
	}

});

$app->run();