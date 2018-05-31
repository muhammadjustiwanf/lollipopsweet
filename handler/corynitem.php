<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function corynitem($query, $userId){
	
	$URL = 'http://coryn.club/item.php';
	
	if ($query == null){
		$result = new TextMessageBuilder("Coryn Item Search Engine.\n\nKetik: .corynitem [nama item]\nContoh: .corynitem mithril\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
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
