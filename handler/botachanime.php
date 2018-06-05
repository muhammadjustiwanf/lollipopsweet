<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function achanimelyric($userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	$URL = 'http://www.achanime.net/megumi-kato-cv-kiyono-yasuno-eternal♭-lyrics/';

	$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
	if ($response == null){
		$result = new TextMessageBuilder('Error atau hasil pencarian tidak ditemukan. Silahkan coba lagi~');
	} else {
		$result = new TextMessageBuilder($json['div']['p']);
		}
	
	return $result;

}

