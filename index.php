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
			if (count($pesan_datang) > 2){
				for ($i = 2; $i < count($pesan_datang); $i++){
					$options .= '+';
					$options .= $pesan_datang[$i];
				}
			}

function ytsearch($keyword) {
    $uri = "http://rahandiapi.herokuapp.com/youtubeapi/search?key=betakey&q=" . $keyword;

    $keyword = urlencode($keyword);
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

function githubrepo($keyword) { 
    $uri = "https://api.github.com/search/repositories?q=" . $keyword; 
 
    $keyword = urlencode($keyword);
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result = "====[GithubRepo]====";
    $result .= "\n====[1]====";
    $result .= "\nResult : ";
    $result .= $json['total_count'];
    $result .= "\nNama Repository : ";
    $result .= $json['items']['name'];
    $result .= "\nNama Github : ";
    $result .= $json['items']['full_name'];
    $result .= "\nLanguage : ";
    $result .= $json['items']['language'];
    $result .= "\nUrl Github : ";
    $result .= $json['items']['owner']['html_url'];
    $result .= "\nUrl Repository : ";
    $result .= $json['items']['html_url'];
    $result .= "\nPrivate : ";
    $result .= $json['items']['private'];
    $result .= "\n====[2]====";
    $result .= "\nResult : ";
    $result .= $json['total_count'];
    $result .= "\nNama Repository : ";
    $result .= $json['items']['name'];
    $result .= "\nNama Github : ";
    $result .= $json['items']['full_name'];
    $result .= "\nLanguage : ";
    $result .= $json['items']['language'];
    $result .= "\nUrl Github : ";
    $result .= $json['items']['owner']['html_url'];
    $result .= "\nUrl Repository : ";
    $result .= $json['items']['html_url'];
    $result .= "\nPrivate : ";
    $result .= $json['items']['private'];
    $result .= "\n====[3]====";
    $result .= "\nResult : ";
    $result .= $json['total_count'];
    $result .= "\nNama Repository : ";
    $result .= $json['items']['name'];
    $result .= "\nNama Github : ";
    $result .= $json['items']['full_name'];
    $result .= "\nLanguage : ";
    $result .= $json['items']['language'];
    $result .= "\nUrl Github : ";
    $result .= $json['items']['owner']['html_url'];
    $result .= "\nUrl Repository : ";
    $result .= $json['items']['html_url'];
    $result .= "\nPrivate : ";
    $result .= $json['items']['private'];
    $result .= "\n====[GithubRepo]====\n";
    $result .= "\n\nPencarian : Google";
    $result .= "\n====[GithubRepo]====";
    return $result; 
}

function img_search($keyword) {
    $uri = 'https://www.google.co.id/search?q=' . $keyword . '&safe=off&source=lnms&tbm=isch';

    $keyword = urlencode($keyword);
    $response = Unirest\Request::get("$uri");

    $hasil = str_replace(">", "&gt;", $response->raw_body);
    $arrays = explode("<", $hasil);
    return explode('"', $arrays[291])[3];
}

function ytdownload($keyword) {
    $uri = "http://wahidganteng.ga/process/api/b82582f5a402e85fd189f716399bcd7c/youtube-downloader?url=" . $keyword;

    $keyword = urlencode($keyword);
    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Judul : \n";
	$result .= $json['title'];
	$result .= "\nType : ";
	$result .= $json['data']['type'];
	$result .= "\nUkuran : ";
	$result .= $json['data']['size'];
	$result .= "\nLink : ";
	$result .= $json['data']['link'];
    return $result;
}

function lokasi($keyword) { 
    $uri = "https://time.siswadi.com/pray/" . $keyword; 
    
    $keyword = urlencode($keyword);
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result['address'] .= $json['location']['address'];
 $result['latitude'] .= $json['location']['latitude'];
 $result['longitude'] .= $json['location']['longitude'];
    return $result; 
}

if ($type == 'join') {
    $text = "Hai " . $profil->displayName . ", Terimakasih telah menambahkan bot ke grup kalian. Untuk info keyword, coba ketik:\n\n.keyword\natau\n.help\n";
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
if($message['type']=='text') {
	    if ($command == '.myinfo') {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(

										'type' => 'text',					
										'text' => "====[Info Profil]====\n\n→ Nama: " . $profil->displayName . "\n→ Status: " . $profil->statusMessage . "\n→ Gambar Profil: " . $profil->pictureUrl
									)
							)
						);
				
	} else if ($command == '.bye') {

$push = array(
							'to' => $groupId,									
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Sayonara~'
									)
							)
						);
						
		
		$client->pushMessage($push);

        $psn = $client->leaveGroup($groupId);
    } else if ($command == '.carigambar') {

        $result = img_search($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $result,
                    'previewImageUrl' => $result
                )
            )
        );
    } else if ($command == '.gitsearch') {

        $result = githubrepo($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    } else if ($command == '.ytsearch') {

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
    } else if ($command == '.ytcont') {

        $keyword = '';
        $keyword = urlencode($keyword);
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
    } else if ($command == '.ytdown') {

        $result = ytdownload($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => ytdownload($options)
                )
            )
        );
    } else if ($command == '.lokasi') {

        $result = lokasi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'location',
                    'title' => 'Lokasi',
                    'address' => $result['address'],
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude']
                ),
            )
        );
    } else if ($command == '.keyword') {

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
										        'text' => 'Silahkan Dipilih ',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Instagram Photo',
										            'data' => 'action=add&itemid=111',
													'text' => '.instagram'
										          ),
										          1 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Kalkulator',
										            'data' => 'action=add&itemid=111',
													'text' => '.calculate'
												  ),
										          2 => 
										          array (
										            'type' => 'postback',
										            'label' => 'User ID',
										            'data' => 'action=add&itemid=111',
													'text' => '.userid'
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
										            'label' => 'Meme Generator ID',
										            'data' => 'action=add&itemid=111',
													'text' => '.memeid'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Meme Maker',
													'data' => 'action=add&itemid=111',
													'text' => '.meme'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Random Comics (xkcd)',
													'data' => 'action=add&itemid=111',
													'text' => '.xkcd'
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
										            'label' => 'Kerang Ajaib 1',
										            'data' => 'action=add&itemid=111',
													'text' => '.apakah'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Kerang Ajaib 2',
													'data' => 'action=add&itemid=111',
													'text' => '.dimana'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Tanggal',
													'data' => 'action=add&itemid=111',
													'text' => '.tanggal'
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
										            'label' => 'Coryn Item Search',
										            'data' => 'action=add&itemid=111',
													'text' => '.corynitem'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Coryn Monster Search',
													'data' => 'action=add&itemid=111',
													'text' => '.corynmob'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Penulisan Rupiah',
													'data' => 'action=add&itemid=111',
													'text' => '.rp'
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
										            'label' => 'Prediksi Cuaca',
										            'data' => 'action=add&itemid=111',
													'text' => '.prediksicuaca'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Jadwal Shalat',
													'data' => 'action=add&itemid=111',
													'text' => '.jadwalshalat'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Server Checker',
													'data' => 'action=add&itemid=111',
													'text' => '.server'
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
										            'label' => 'Cari Zodiak',
										            'data' => 'action=add&itemid=111',
													'text' => '.zodiak'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Produk Halal MUI',
													'data' => 'action=add&itemid=111',
													'text' => '.produk'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'COMING SOON',
													'data' => 'action=add&itemid=111',
													'text' => '-'
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
										            'label' => 'COMING SOON',
										            'data' => 'action=add&itemid=111',
													'text' => '-'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'About',
													'data' => 'action=add&itemid=111',
													'text' => '.aboutme'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'COMING SOON',
													'data' => 'action=add&itemid=111',
													'text' => '-'
										          ),
										        ),
										      ),											  
										    ),
										  ),
										)					
			 
        )
    );
  }
}
/*if ($message['type'] == 'sticker') {
			 
			 $balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => $profil->displayName . ', Stikernya keren 😎'										
									
									)
							)
						);
}*/

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