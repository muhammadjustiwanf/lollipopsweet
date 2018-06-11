<?php

require 'line_class.php';
require 'vendor/autoload.php';
include './unirest-php-master/src/Unirest.php';

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

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

function img_search($keyword) {
    $uri = 'https://www.google.co.id/search?q=' . $keyword . '&safe=off&source=lnms&tbm=isch';

    $response = Unirest\Request::get("$uri");

    $hasil = str_replace(">", "&gt;", $response->raw_body);
    $arrays = explode("<", $hasil);
    return explode('"', $arrays[291])[3];
}

function anime($keyword) {

    $fullurl = 'https://myanimelist.net/api/anime/search.xml?q=' . $keyword;
    $username = 'buntutkadal';
    $password = 'FZQYeZ6CE9is';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_URL, $fullurl);

    $returned = curl_exec($ch);
    $xml = new SimpleXMLElement($returned);
    $parsed = array();

    $parsed['id'] = (string) $xml->entry[0]->id;
    $parsed['image'] = (string) $xml->entry[0]->image;
    $parsed['title'] = (string) $xml->entry[0]->title;
    $parsed['desc'] = "Episodes : ";
    $parsed['desc'] .= $xml->entry[0]->episodes;
    $parsed['desc'] .= "\nScore : ";
    $parsed['desc'] .= $xml->entry[0]->score;
    $parsed['desc'] .= "\nType : ";
    $parsed['desc'] .= $xml->entry[0]->type;
    $parsed['synopsis'] = str_replace("<br />", "\n", html_entity_decode((string) $xml->entry[0]->synopsis, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
    return $parsed;
}

function anime_syn($title) {
    $parsed = anime($title);
    $result = "Title : " . $parsed['title'];
    $result .= "\n\nSynopsis :\n" . $parsed['synopsis'];
    return $result;
}

function urb_dict($keyword) {
    $uri = "http://api.urbandictionary.com/v0/define?term=" . $keyword;

    $response = Unirest\Request::get("$uri");


    $json = json_decode($response->raw_body, true);
    $result = $json['list'][0]['definition'];
    $result .= "\n\nExamples : \n";
    $result .= $json['list'][0]['example'];
    return $result;
}

//show menu, saat join dan command #/menu
if ($type == 'join' || $command == '#/menu') {
    $text = "mbeek (´▽｀)\nHere how to use me\n\n";
    $text .= "1.#/def [keyword] - define something\n";
    $text .= "2.#/img [keyword] - search image for something\n";
    $text .= "3.#/anime [keyword] - search for an anime from MAL\n";
    $text .= "4.#/anime-syn [keyword] - read an anime synopsis from MAL\n";
    $text .= "5.#/goaway - I will leave this group";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}

//pesan bergambar
if ($message['type'] == 'text') {
    if ($command == '#/def') {


        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Definition : ' . urb_dict($options)
                )
            )
        );
    } else if ($command == '#/goaway') {

$push = array(
							'to' => $groupId,									
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'here is my poo...'
									)
							)
						);
						
		
		$client->pushMessage($push);

        $psn = $client->leaveGroup($groupId);
    } else if ($command == '#/img') {
        $hasil = img_search($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $hasil,
                    'previewImageUrl' => $hasil
                )
            )
        );
    } else if ($command == '#/pika') {
        $keyword = 'Zl_ZeIMHWjc';
        $image = 'https://img.youtube.com/vi/' . $keyword . '/2.jpg';
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $image,
                    'previewImageUrl' => $image
                ), array(
                    'type' => 'video',
                    'originalContentUrl' => vid_search($keyword),
                    'previewImageUrl' => $image
                )
            )
        );
    } else if ($command == '#/anime') {
        $result = anime($options);
        $altText = "Title : " . $result['title'];
        $altText .= "\n\n" . $result['desc'];
        $altText .= "\nMAL Page : https://myanimelist.net/anime/" . $result['id'];
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => $altText,
                    'template' => array(
                        'type' => 'buttons',
                        'title' => $result['title'],
                        'thumbnailImageUrl' => $result['image'],
                        'text' => $result['desc'],
                        'actions' => array(
                            array(
                                'type' => 'postback',
                                'label' => 'Read Synopsis',
                                'data' => 'action=add&itemid=123',
                                'text' => '#/anime-syn ' . $options
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Myanimelist Page',
                                'uri' => 'https://myanimelist.net/anime/' . $result['id']
                            )
                        )
                    )
                )
            )
        );
    } else if ($command == '#/anime-syn') {

        $result = anime_syn($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);

}

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