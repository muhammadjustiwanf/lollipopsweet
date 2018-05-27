<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder('Kita belum berteman kak, add dulu gih :v');
				} else {
				$result = new TextMessageBuilder("Hai kak, Ini adalah userid kakak\n\nUserId: ".$userId."\n\nDisimpan baik2 yah UserId nya :)");
		}

		return $result;

}