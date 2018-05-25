<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder('Hai Kak ' . $profile->displayName . ' Kita belum berteman, add dulu gih :v');
		} else {
				$result = new TextMessageBuilder('Hai Kak ' . $profile->displayName . ' Ini adalah userId kakak: ' . $userId);
		}

		return $result;

}