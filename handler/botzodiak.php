<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function zodiak($query, $displayName){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	
	$URL = 'https://script.google.com/macros/exec';
	$appkey = 'AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w';
	$nama = 'anda';
	$tanggal = $query;
	
	if ($query == null){
		$result = new TextMessageBuilder("(((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$URL = $URL . '?service=' . $appkey;
		$URL = $URL . '&nama=' . $nama;
		$URL = $URL . '&tanggal=' . $query;

		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if (isset($json['error'])){
			$result = new TextMessageBuilder('Error atau hasil pencarian tidak ditemukan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder("Zodiak " . $nama . ":\n\nTanggal: " . $query . "\nLahir: " . $json['data']['lahir'] . "\nUsia: " . $json['data']['usia'] . "\nUltah: " . $json['data']['ultah'] . "\nZodiak: " . $json['data']['zodiak']);
			}
		
		}
	
	return $result;

}

