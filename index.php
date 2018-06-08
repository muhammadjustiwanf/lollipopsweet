<?php

require 'vendor/autoload.php';

use LINE\LINEBot\SignatureValidator as SignatureValidator;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
foreach (glob("handler/*.php") as $handler){
		if ($handler != 'handler/post.php'){
				include $handler;
		}
}

spl_autoload_register(function ($class_name){
		include  $class_name.'.php';
});

// load config
try{
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();
}catch (Exception $e){
}

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new Slim\App(['settings' => $config]);
$container = $app->getContainer();

$app->get('/', function (Request $request, Response $response){
		ini_set('display_errors', 1);
		$user = User::findOne(['user_id' => 'Ue84692bbf94c980be363679272ec7eb2']);
		die(print_r(User::getTopTen(),1 ));
		return "Sukses mendeploy. Silahkan dicoba botnya";
});

$app->get('/profile/{id}', function (Request $request, Response $response, $args){
		$access_token = getenv('CHANNEL_ACCESS_TOKEN');
		$secret = getenv('CHANNEL_SECRET');
		$pass_signature = getenv('PASS_SIGNATURE');

	$http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
	$bot = new \LINE\LINEBot($http_client,['channelSecret' => $secret]);

	$profile = $bot->getProfile($args['id']);

	return print("<pre>".print_r($profile->getJSONDecodedBody(),1)."</pre>");
});

$app->post('/', function (Request $request, Response $response){

	$access_token = getenv('CHANNEL_ACCESS_TOKEN');
	$secret = getenv('CHANNEL_SECRET');
	$pass_signature = getenv('PASS_SIGNATURE');

	// get request body and line signature header
	$body 	   = file_get_contents('php://input');
	$signature = $_SERVER['HTTP_X_LINE_SIGNATURE'];

	// log body and signature
	file_put_contents('php://stderr', 'Body: '.$body);

	// is LINE_SIGNATURE exists in request header?
	if (empty($signature)){
        return $response->withStatus(400, 'Signature not set');
    }
	if($pass_signature == 'false' && ! SignatureValidator::validateSignature($body,$secret, $signature)){
        return $response->withStatus(400, 'Invalid Signature');
    }

	$http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
	$bot = new \LINE\LINEBot($http_client,['channelSecret' => $secret]);

	$data = json_decode($body, true);
	foreach ($data['events'] as $event)
	{
		if ($event['type'] == 'message')
		{

			if($event['message']['type'] == 'text')
			{
				
				// --------------------------------------------------------------- NOTICE ME...
				
				$inputMessage = $event['message']['text'];
				$userId = $event['source']['userId'];

				if ($inputMessage[0] == '.') {

					 $inputMessage = ltrim($inputMessage, '.');
					 $inputSplit = explode(' ', $inputMessage, 2);

					 if ( function_exists( $inputSplit[0] ) ){

							$outputMessage = $inputSplit[0]( $inputSplit[1], $userId );

					 } else {
				$outputMessage = new TextMessageBuilder('tipe command tidak ditemukan :v');
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
				
			}
		}
	}

});

$app->run();