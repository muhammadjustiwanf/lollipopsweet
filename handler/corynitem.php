<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function corynitem($query, $userId){
	
	$URL = 'http://coryn.club/item.php';
	
	if ($query == null){
		$result = new TextMessageBuilder("Meme Generator\n\nCara menggunakan:\n.memeid query\n.meme 'memeid' Teks atas|Teks bawah\n\nContoh:\n.memeid Kocak\n/meme 689854 Kids zaman now|Generasi Micin.\n\nSilahkan dicoba  (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?name=' . $query;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);
		
		$item = $json['result'][0]['item'];
		
		if ($item == null){
			$result = new TextMessageBuilder('Item tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder('Klik: ' . $item);
		}
		
	}
	
	return $result;

}
