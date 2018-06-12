<?php

use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder as ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function meme($query, $userId){
	
	$URL = 'http://version1.api.memegenerator.net/Instance_Create';
	$apiKey = '62115028-fca1-43c3-897e-57ee3e105eaa';
	
	if ($query == null){
		$result = new TextMessageBuilder("Meme Generator\n\nCara menggunakan:\n.meme [MemeID] Teks Atas|Teks Bawah\n\nContoh:\n.meme 689854 Kids zaman now|Generasi micin.\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {
		
		$query = explode(' ', $query, 2);
		$generatorID = urlencode($query[0]);
		
		$text = explode('|', $query[1]);
		$teksAtas = urlencode($text[0]);
		$teksBawah = urlencode($text[1]);

		$URL = $URL . '?generatorID=' . $generatorID;
		$URL = $URL . '&text0=' . $teksAtas;
		$URL = $URL . '&text1=' . $teksBawah;
		$URL = $URL . '&apiKey=' . $apiKey;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);
		
		$imageUrl = $json['result']['instanceImageUrl'];
		
		if ($imageUrl == null){
			$result = new TextMessageBuilder('Syntax error atau generator id tidak ditemukan.');
		} else {
			$result = new ImageMessageBuilder($imageUrl, $imageUrl);
		}
		
	}
	
	return $result;

}
