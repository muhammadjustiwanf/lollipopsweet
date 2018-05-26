<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
use \LINE\LINEBot\Response;

function userid($query, $profile){

		if ($userId == null){
				$result = new TextMessageBuilder('Kita belum berteman kak, ' . $displayName . ' add dulu gih :v');
				} else {
				$result = new TextMessageBuilder('Hai kak ' . $displayName . ' Ini adalah userid kakak: ' . $userId);
		}

		return $result;

}