<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function jadwalshalat($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	$URL = 'https://time.siswadi.com/';
	
	if ($query == null){
		$result = new TextMessageBuilder("Jam berapa waktunya shalat? Nih, bot bisa memberi tahu kamu jadwal kapan waktunya shalat lho..😆 Caranya cukup mudah, yuk cek dengan cara:\n\nKetik: .jadwalshalat [kota]\nContoh: .jadwalshalat Jakarta\n\nSilahkan dicoba yah~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . 'pray/' . $query;
		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if ($response == null){
			$result = new TextMessageBuilder('Error atau tidak ditemukan hasil yang relevan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder("Jadwal shalat untuk wilayah:\n" . $json['location']['address'] . " Dan Sekitarnya.\nTanggal: " . $json['time']['date'] . "\n\nSubuh: " . $json['data']['Fajr'] . "\nZuhur: " . $json['data']['Dhuhr'] . "\nAshar: " . $json['data']['Asr'] . "\nMaghrib: " . $json['data']['Maghrib'] . "\nIsya: " . $json['data']['Isha'] . "\nSepertiga malam: " . $json['data']['SepertigaMalam'] . "\nTengah Malam: " . $json['data']['TengahMalam'] . "\nDuapertiga Malam: " . $json['data']['DuapertigaMalam'] . "\n\nDiakses pada pukul: " . $json['time']['time']);
		}
		
	}
	
	return $result;

}

