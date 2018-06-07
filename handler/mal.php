<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function malanime($query, $userId){
	
	include 'jikan-me/jikan';
	date_default_timezone_set('Asia/Jakarta');
	$jikan = new Jikan\Jikan;
	$URL = 'https://myanimelist.net/anime.php';
	
	if ($query == null){
		$result = new TextMessageBuilder("(((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?q=' . $query;
		$jikan->Search($URL, ANIME);
		
		if ($jikan == null){
			$result = new TextMessageBuilder('Error atau hasil pencarian tidak ditemukan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder($jikan->response['result_last_page'] . "\n\nSee More: " . $URL);
			}
		
		}
	
	return $result;

}

