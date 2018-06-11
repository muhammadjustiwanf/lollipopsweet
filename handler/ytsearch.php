<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function ytsearch($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	$query = explode(" ", $message['text']);
	$command = $query[0];
	$options = $query[1];
	if (count($query) > 2) {
    for ($i = 2; $i < count($query); $i++) {
        $options .= '+';
        $options .= $query[$i];
    }
}
	$URL = 'http://rahandiapi.herokuapp.com/youtubeapi/search';
	
	if ($query == null){
		$result = new TextMessageBuilder("YouTube Search Engine.\n\nKetik: .ytsearch [video]\nContoh: .ytsearch vitas\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?key=betakey&q=' . $query;
		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if ($json['error']){
			$result = new TextMessageBuilder('Video ' . $query . ' tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder("Result from " . $query . ":\n\nChannel: " . $json['result']['author'] . "\nJudul: " . $json['result']['title'] . "\nDurasi: " . $json['result']['duration'] . "\nLikes: " . $json['result']['likes'] . "\nDislikes: " . $json['result']['dislikes'] . "\nViewer: " . $json['result']['viewcount'] . "\nLink Thumbnail: " . $json['result']['thumbnail'] . "\n\nDiakses pada pukul: " . date('H:i:s'));
			}
		
		}

	return $result;

}

			$balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
		            $hasil = ytsearch($options);
		            $hasill = thumbnail($options);
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

  $client->replyMessage($balas);
