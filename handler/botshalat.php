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

		$teks = 'Jadwal Shalat Sekitar ' . $query . ':';
		$teks .= $json['location']['address'];
		$teks .= "\nTanggal : ";
		$teks .= $json['time']['date'];
		$teks .= "\n\nShubuh : ";
		$teks .= $json['data']['Fajr'];
		$teks .= "\nDzuhur : ";
		$teks .= $json['data']['Dhuhr'];
		$teks .= "\nAshar : ";
		$teks .= $json['data']['Asr'];
		$teks .= "\nMaghrib : ";
		$teks .= $json['data']['Maghrib'];
		$teks .= "\nIsya : ";
		$teks .= $json['data']['Isha'];
			return $teks;
		
		if ($teks == null){
			$result = new TextMessageBuilder('nothing');
		} else {
			$result = new TextMessageBuilder($teks);
		}
		
	}
	
	return $result;

}
