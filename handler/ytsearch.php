<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function ytsearch($query, $userId){
	
	$URL = 'https://www.youtube.com/results';
	
	if ($query == null){
		$result = new TextMessageBuilder("YouTube Search Engine.\n\nKetik: .ytsearch [video]\nContoh: .ytsearch vitas\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?search_query=' . $query;
		
		if ($URL == null){
			$result = new TextMessageBuilder('Video ' . $query . ' tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder('Klik: ' . $URL);
		}
		
	}
	
	return $result;

}
