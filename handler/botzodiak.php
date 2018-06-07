<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function zodiak($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	$URL = 'https://script.googleusercontent.com/macros/echo';
	$appkey = 'vAGi-qzG0c1hjd2tJl-pvx1bVNy1VbIduIDVU_6MaTd5TpsRToz2Ya5idTk1XYwIJhX1VOcIqvgrVTFGd6RTNcPkZB-698LKOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuB6lHT6qnqYcmFWggwoSVQQ5YeASoMK9PZPVGfbDuDg1P_UvtMjPxyA1dR6I62-l7IRC_FwXIIs97iVtBFTFTgErNAAsrl-RiPF72dnZtWOR9ArHmXqEYVKo2uU_jsNmrfIKOhNJrljag&lib=M7TYb5FpQbpg081_3slURkuWXe3zpGnIr';
	
	if ($query == null){
		$result = new TextMessageBuilder("Hmm... Cuaca hari ini mendung, cerah, atau hujan yah? Nih, bot bisa memberi tahu kamu prediksi cuaca di kota kamu lho..😆 Caranya cukup mudah, yuk cek dengan cara:\n\nKetik: .prediksicuaca [kota]\nContoh: .prediksicuaca Jakarta\n\nKarena ini prediksi, jadi tidak 100% akurat yah ^^\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$URL = $URL . '?user_content_key=' . $appkey;
		
		$client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET']);
		$userId = $client->parseEvents()[0]['source']['userId'];
		$profil = $client->profil($userId);
		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if ($response == null){
			$result = new TextMessageBuilder('Error atau hasil pencarian tidak ditemukan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder("Zodiak " . $profil->displayName . ":\n\nTanggal: " . $query . "\nLahir: " . $json['data']['lahir'] . "\nUsia: " . $json['data']['usia'] . "\nUltah: " . $json['data']['ultah'] . "\nZodiak: " . $json['data']['zodiak']);
			}
		
		}
	
	return $result;

}

