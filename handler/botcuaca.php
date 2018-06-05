<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function prediksicuaca($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	$URL = 'http://api.openweathermap.org/data/2.5/weather';
	$appid = 'e172c2f3a3c620591582ab5242e0e6c4';
	
	if ($query == null){
		$result = new TextMessageBuilder("Hmm... Cuaca hari ini mendung, cerah, atau hujan yah? Nih, bot bisa memberi tahu kamu prediksi cuaca di kota kamu lho..😆 Caranya cukup mudah, yuk cek dengan cara:\n\nKetik: .prediksicuaca [kota]\nContoh: .prediksicuaca Jakarta\n\nKarena ini prediksi, jadi tidak 100% akurat yah ^^\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?q=' . $query;
		$URL = $URL . ',ID&units=metric';
		$URL = $URL . '&appid=' . $appid;
		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if ($response == null){
			$result = new TextMessageBuilder('Error atau hasil pencarian tidak ditemukan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder("Prediksi Cuaca pada kota " . $json['name'] . "\nTanggal: " . date['j F Y'] . "\n\nCuaca: " . $json['weather']['0']['main'] . "\nTemperatur: " . $json['main']['temp'] . "° C\nDeskripsi: " . $json['weather']['0']['description'] . "\nKecepatan angin: " . $json['wind']['speed'] . " km/h\nTekanan: " . $json['main']['pressure'] . " mb\n\nDiakses pada pukul: " . date['H:i:s']);
			}
		
		}
	
	return $result;

}

