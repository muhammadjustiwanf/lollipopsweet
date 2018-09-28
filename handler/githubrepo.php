<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function repo($query, $userId) { 

	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	$URL = 'https://api.github.com/';

	if ($query == null){
		$result = new TextMessageBuilder("Github Repositories\n-------------------\n\nCommand: .repo [text]\nContoh: .repo selfbot line");
	} else {

		$query = urlencode($query);
		$URL = $URL . 'search/repositories';
		$URL = $URL . '?q=' . $query;
		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);

		if ($json['error']){
			$result = new TextMessageBuilder('Error atau hasil pencarian dengan keyword ' . $query . ' tidak ditemukan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder("====[GithubRepo]====\n====[1]====\nResult : " . $json['total_count'] . "\nNama Repository : " . $json['items']['name'] . "\nNama Github : " . $json['items']['full_name'] . "\nLanguage : " . $json['items']['language'] . "\nUrl Github : " . $json['items']['owner']['html_url'] . "\nUrl Repository : " . $json['items']['html_url'] . "\nPrivate : " . $json['items']['private'] . "\n====[2]====\nResult : " . $json['total_count'] . "\nNama Repository : " . $json['items']['name'] . "\nNama Github : " . $json['items']['full_name'] . "\nLanguage : " . $json['items']['language'] . "\nUrl Github : " . $json['items']['owner']['html_url'] . "\nUrl Repository : " . $json['items']['html_url'] . "\nPrivate : " . $json['items']['private'] . "\n====[3]====\nResult : " . $json['total_count'] . "\nNama Repository : " . $json['items']['name'] . "\nNama Github : " . $json['items']['full_name'] . "\nLanguage : " . $json['items']['language'] . "\nUrl Github : " . $json['items']['owner']['html_url'] . "\nUrl Repository : " . $json['items']['html_url'] . "\nPrivate : " . $json['items']['private'] . "\n====[GithubRepo]====\n\nSumber: Google");
			}
		
		}
	
	return $result;

}
