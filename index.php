<?php

require __DIR__ . '/vendor/autoload.php';
//require_once('./line_class.php');
//require_once('./unirest-php-master/src/Unirest.php');

use \LINE\LINEBot\SignatureValidator as SignatureValidator;

//var_dump($client->parseEvents());


//$_SESSION['userId']=$client->parseEvents()[0]['source']['userId'];

// load config
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// initiate app
$configs =  [
	'settings' => ['displayErrorDetails' => true],
];
$app = new Slim\App($configs);

/* ROUTES */
$app->get('/', function ($request, $response) {
	return "Lanjutkan!";
});

$app->post('/', function ($request, $response)
{
	// get request body and line signature header
	$body 	   = file_get_contents('php://input');
	$signature = $_SERVER['HTTP_X_LINE_SIGNATURE'];

	// log body and signature
	file_put_contents('php://stderr', 'Body: '.$body);

	// is LINE_SIGNATURE exists in request header?
	if (empty($signature)){
		return $response->withStatus(400, 'Signature not set');
	}

	// is this request comes from LINE?
	if($_ENV['PASS_SIGNATURE'] == false && ! SignatureValidator::validateSignature($body, $_ENV['CHANNEL_SECRET'], $signature)){
		return $response->withStatus(400, 'Invalid signature');
	}

	// init bot
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

		}
	}

});

$app->run();