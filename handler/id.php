<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){
	
	if ($userId == null){
		$result = new TextMessageBuilder('Kita belum berteman kak, add dulu gih :v');
	} else {
		$result = new TextMessageBuilder("Hai kak, ini adalah userid kakak\n\nuserid: ".$userId."\n\nDisimpan baik2 yah userid nya :)");
	}
	
	return $result;
	
}

