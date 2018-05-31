<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function corynitem($query, $userId){
	
	$URL = 'http://coryn.club/item.php';
	
	if ($query == null){
		$result = new TextMessageBuilder("Meme Generator\n\nCara menggunakan:\n.memeid query\n.meme 'memeid' Teks atas|Teks bawah\n\nContoh:\n.memeid Kocak\n/meme 689854 Kids zaman now|Generasi Micin.\n\nSilahkan dicoba  (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?name=' . $query;
		
		if ($URL == null){
			$result = new TextMessageBuilder('Item ' . $query . ' tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder('Klik: ' . $URL);
		}
		
	}
	
	return $result;

}
