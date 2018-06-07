<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function zodiak($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	
	$URL = 'https://script.google.com/macros/exec';
	$appkey = 'AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w';
	$tanggal = $query;
	
	if ($query == null){
		$result = new TextMessageBuilder("Hmm... Cuaca hari ini mendung, cerah, atau hujan yah? Nih, bot bisa memberi tahu kamu prediksi cuaca di kota kamu lho..😆 Caranya cukup mudah, yuk cek dengan cara:\n\nKetik: .prediksicuaca [kota]\nContoh: .prediksicuaca Jakarta\n\nKarena ini prediksi, jadi tidak 100% akurat yah ^^\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET']);
		$userId = $client->parseEvents()[0]['source']['userId'];
		$profil = $client->profil($userId);
		
		$URL = $URL . '?service=' . $appkey;
		$URL = $URL . '&nama=' . $profil->displayName;
		$URL = $URL . '&tanggal=' . $query;

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

