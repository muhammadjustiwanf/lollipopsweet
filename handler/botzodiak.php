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
		$result = new TextMessageBuilder("Ketik: .zodiak [tgl-bln-thn kamu]\nContoh: .zodiak 01-01-2000\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$URL = $URL . '?service=' . $appkey;
		$URL = $URL . '&nama=' . $nama;
		$URL = $URL . '&tanggal=' . $query;

		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if (isset($json['error']))
			$result = new TextMessageBuilder('Tanggal ' . $query . ' tidak ditemukan. ngetik yang bener, jangan typo! :v');
		else
			$result = new TextMessageBuilder("Zodiak " . $nama . ":\n\nTanggal: " . $query . "\nLahir: " . $json['data']['lahir'] . "\nUsia: " . $json['data']['usia'] . "\nUltah: " . $json['data']['ultah'] . "\nZodiak: " . $json['data']['zodiak']);
		
		}
	
	return $result;

}

