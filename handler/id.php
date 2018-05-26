<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder("Kita belum berteman kak, '.$profile['displayName'].' add dulu gih :v");
				} else {
				$result = new TextMessageBuilder("Hai kak '.$profile['displayName'].' Ini adalah userid kakak:\n".$userId);
		}

		return $result;

}