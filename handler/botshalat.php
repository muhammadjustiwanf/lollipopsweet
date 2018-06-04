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
  $hasil = [
    $result = "Jadwal Shalat Sekitar ";
	$result .= $json['location']['address'];
	$result .= "\nTanggal : ";
	$result .= $json['time']['date'];
	$result .= "\n\nShubuh : ";
	$result .= $json['data']['Fajr'];
	$result .= "\nDzuhur : ";
	$result .= $json['data']['Dhuhr'];
	$result .= "\nAshar : ";
	$result .= $json['data']['Asr'];
	$result .= "\nMaghrib : ";
	$result .= $json['data']['Maghrib'];
	$result .= "\nIsya : ";
	$result .= $json['data']['Isha'];
    return $result;
];
		
		if ($URL == null){
			$result = new TextMessageBuilder('nothing');
		} else {
			$result = new TextMessageBuilder($hasil);
		}
		
	}
	
	return $result;

}
