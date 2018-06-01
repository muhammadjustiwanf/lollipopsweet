<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function corynmob($query, $userId){
	
	$URL = 'http://coryn.club/monster.php';
	
	if ($query == null){
		$result = new TextMessageBuilder("Coryn Monster Search Engine.\n\nKetik: .corynmob [nama monster]\nContoh: .corynmob ifrid\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?name=' . $query;
		
		if ($URL == null){
			$result = new TextMessageBuilder('Monster ' . $query . ' tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder('Klik: ' . $URL);
		}
		
	}
	
	return $result;

}
