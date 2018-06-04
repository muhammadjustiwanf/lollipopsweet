<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function jadwalshalat($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	$URL = 'https://time.siswadi.com/';
	
	if ($query == null){
		$result = new TextMessageBuilder("(((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . 'pray/' . $query;
		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if ($URL == null){
			$result = new TextMessageBuilder('nothing');
		} else {
			$result = new TextMessageBuilder("Jadwal Shalat Sekitar " . $query . ":\nTanggal: " . $json['time']['date'] . "\n\nSubuh: " . $json['data']['Fajr'] . "\nZuhur: " . $json['data']['Dhuhr'] . "\nAshar: " . $json['data']['Asr'] . "\nMaghrib: " . $json['data']['Maghrib'] . "\nIsya: " . $json['data']['Isha'] . "\n\nTerimakasih :)");
		}
		
	}
	
	return $result;

}
//$json['location']['address'];
