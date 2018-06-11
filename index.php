<?php

require __DIR__ . '/vendor/autoload.php';
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

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
		if ($event['type'] == 'message')
/*
{
  "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
  "type": "message",
  "timestamp": 1462629479859,
  "source": {
    "type": "user",
    "userId": "U45a70016f56dbfc99e6a66673002ecbe"
  },
  "message": {
    "id": "325708",
    "type": "text",
    "text": "Hello, world"
  }
}
*/
	$userId 	= $client->parseEvents()[0]['source']['userId'];
	$replyToken = $client->parseEvents()[0]['replyToken'];
	$timestamp	= $client->parseEvents()[0]['timestamp'];

	$type 		= $client->parseEvents()[0]['type'];

	$message 	= $client->parseEvents()[0]['message'];
	$messageid 	= $client->parseEvents()[0]['message']['id'];

	$profil = $client->profil($userId);

	$pesan_datang = $message['text'];
$msg_type = $message['type'];
$botname = "BotLine"; //Nama bot

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

function jawabs(){
    $list_jwb = array(
		'Ya',
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == '.apakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} else {}

if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
    file_put_contents($botname.'.json',$result);
}
$res = $bot->getProfile('user-id');
if ($res->isSucceeded()) {
    $profile = $res->getJSONDecodedBody();
    $displayName = $profile['displayName'];
    $statusMessage = $profile['statusMessage'];
    $pictureUrl = $profile['pictureUrl'];
}
	{
		$userMessage = $event['message']['text'];
		if(strtolower($userMessage) == 'halo')
		{
			$message = "Halo juga";
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
			$result = $bot->replyMessage($event['replyToken'], $textMessageBuilder);
			return $result->getHTTPStatus() . ' ' . $result->getRawBody();
		
		}
if($userMessage == "button template"){
$buttonTemplateBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder(
     "title",
     "text",
     "https://i0.wp.com/angryanimebitches.com/wp-content/uploads/2013/03/tamakomarket-overallreview-tamakoanddera.jpg",
   [
new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('Action Button','action'),
   ]
   );
$templateMessage = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('nama template', $buttonTemplateBuilder);
$result = $bot->replyMessage($event['replyToken'], $templateMessage);
return $result->getHTTPStatus() . ' ' . $result->getRawBody();
}
if($userMessage == ".sendaudio"){
$audioMessage = new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder("https://audio-ssl.itunes.apple.com/appl-assets-us-std-000001/Music69/v4/aa/c9/e5/aac9e54d-6284-1b50-400f-91d4833099c5/mzaf_6172211221372312761.plus.aac.p.m4a","30000"); // Format Audio .M4A serta durasi Audio 30000milisecond (30sec)
$result = $bot->replyMessage($event['replyToken'], $audioMessage);
return $result->getHTTPStatus() . ' ' . $result->getRawBody();     
}
if($userMessage == ".sendpict"){
$imageMessage = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder("https://myanimelist.cdn-dena.com/images/characters/8/320273.jpg","https://myanimelist.cdn-dena.com/images/characters/8/320273.jpg");
$result = $bot->replyMessage($event['replyToken'], $imageMessage);
return $result->getHTTPStatus() . ' ' . $result->getRawBody();     
}
if($message['type']=='text')
{
	if($pesan_datang=='.ceksider')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'hai kak '.$profil->displayName.''
									)
							)
						);
				
	}
	else
	if($pesan_datang=='.sendnotif')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Sending----->>>>>Done.'
									)
							)
						);
						
		$push = array(
							'to' => $userId,									
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Hai kak.. ngapain ngintip2? diem2 bae, sini lah join :p'
									)
							)
						);
						
		
		$client->pushMessage($push);
				
	}
	else
	if($pesan_datang=='.jam')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Jam Server Saya : '. date('Y-m-d H:i:s')
									)
							)
						);
				
	}
$result =  json_encode($balas);
file_put_contents('./balasan.json',$result);
$client->replyMessage($balas);
/*
{
  "events": [
    {
      "replyToken": "0f3779fba3b349968c5d07db31eab56f",
      "type": "message",
      "timestamp": 1462629479859,
      "source": {
        "type": "user",
        "userId": "U4af4980629..."
      },
      "message": {
        "id": "325708",
        "type": "text",
        "text": "Hello, world"
      }
    },
    {
      "replyToken": "8cf9239d56244f4197887e939187e19e",
      "type": "follow",
      "timestamp": 1462629479859,
      "source": {
        "type": "user",
        "userId": "U4af4980629..."
      }
    }
  ]
}
*/
$pesan_datang = explode(" ", $message['text']);
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[Function]-------------------------#
function cuaca($keyword) {
    $uri = "http://api.openweathermap.org/data/2.5/weather?q=" . $keyword . ",ID&units=metric&appid=e172c2f3a3c620591582ab5242e0e6c4";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Halo Kak ^_^ Ini ada Prediksi Cuaca Untuk Daerah ";
	$result .= $json['name'];
	$result .= " Dan Sekitarnya";
	$result .= "\n\nCuaca : ";
	$result .= $json['weather']['0']['main'];
	$result .= "\nDeskripsi : ";
	$result .= $json['weather']['0']['description'];
    return $result;
}
#-------------------------[Function]-------------------------#

# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');

//show menu, saat join dan command .helpcuaca
if ($type == 'join' || $command == '.helpcuaca') {
    $text = "Halo Kak ^_^\nKakak bisa mengetahui prediksi cuaca di daerah kakak loh.. sesuai dengan sumber BMKG, silahkan ketik\n\n.prediksicuaca <nama tempat>\n\n";
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

//pesan 00
if($message['type']=='text') {
	    if ($command == '.prediksicuaca') {

        $result = cuaca($options);
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
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[Function]-------------------------#
function shalat($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Jadwal Shalat Sekitar ";
	$result .= $json['location']['address'];
	$result .= "\nTanggal : ";
	$result .= $json['time']['date'];
	$result .= "\n\nSUBUH : ";
	$result .= $json['data']['Fajr'];
	$result .= "\nZUHUR : ";
	$result .= $json['data']['Dhuhr'];
	$result .= "\nASAR : ";
	$result .= $json['data']['Asr'];
	$result .= "\nMAGRIB : ";
	$result .= $json['data']['Maghrib'];
	$result .= "\nISYA' : ";
	$result .= $json['data']['Isha'];
    return $result;
}
#-------------------------[Function]-------------------------#

# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');

//show menu, saat join dan command .helpshalat
if ($type == 'join' || $command == '.helpshalat') {
    $text = "Assalamualaikum Kak, ingin mengetahui jadwal shalat di tempat kakak? silahkan ketik\n\n.jadwalshalat <nama tempat>\n\nnanti bot bakalan kasih tahu ke kakak jam berapa waktunya shalat ^_^";
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

//pesan 02
if($message['type']=='text') {
	    if ($command == '.jadwalshalat') {

        $result = shalat($options);
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
else
if($message['type']=='sticker')
 {	
        $balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Makasih Kak Stikernya ^_^'										
									
									)
							)
						);
						
}
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
}
	}
});

// $app->get('/push/{to}/{message}', function ($request, $response, $args)
// {
// 	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV['CHANNEL_ACCESS_TOKEN']);
// 	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $_ENV['CHANNEL_SECRET']]);

// 	$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($args['message']);
// 	$result = $bot->pushMessage($args['to'], $textMessageBuilder);

// 	return $result->getHTTPStatus() . ' ' . $result->getRawBody();
// });

/* JUST RUN IT */
$app->run();