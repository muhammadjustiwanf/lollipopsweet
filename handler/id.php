<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
use \LINE\LINEBot\Response;

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder('Kita belum berteman kak, add dulu gih :v');
				} else {
				$result = new TextMessageBuilder('Hai kak ' . $profil->displayName . ' Ini adalah userid kakak: ' . $userId);
		}

		return $result;

}