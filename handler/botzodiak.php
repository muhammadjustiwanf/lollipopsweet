<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function zodiak($query, $displayName){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	
	$URL = 'https://script.google.com/macros/exec';
	$appkey = 'AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w';
	$nama = 'Anda';
	$tanggal = $query;
	
	if ($query == null){
		$result = new TextMessageBuilder("Bot punya suatu hal yang menarik nih... Sekarang bot bisa membantu kamu mengetahui zodiak, usia, ultahmu loh.. Caranya?\n\nKetik: .zodiak [tgl-bln-thn kamu]\nContoh: .zodiak 1-01-2000\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))\n\n★Note: Untuk tanggal kelahiran mulai dari tanggal 01-09 agar hasil estimasi ulang tahunnya terdeteksi/tidak NaN, jangan menggunakan angka 01,02,... tetapi menggunakan angka 1,2,...");
	} else {

		$URL = $URL . '?service=' . $appkey;
		$URL = $URL . '&nama=' . $nama;
		$URL = $URL . '&tanggal=' . $query;

		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if (isset($json['error']))
			$result = new TextMessageBuilder('Tanggal ' . $query . ' tidak ditemukan. Ngetik yang bener yak, jangan typo! :v');
		else
			$result = new TextMessageBuilder("Zodiak " . $profile->displayName . ":\nTanggal: " . $query . "\n\nLahir: " . $json['data']['lahir'] . "\nUmur: " . $json['data']['usia'] . "\nUlang tahun: " . $json['data']['ultah'] . "\nZodiak: " . $json['data']['zodiak'] . "\n\nDiakses pada pukul: " . date('H:i:s'));
		
		}
	
	return $result;

}

