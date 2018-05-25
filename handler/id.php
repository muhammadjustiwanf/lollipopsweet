<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder('Kita belum berteman kak, add dulu gih :v');
		} else {
				$result = $bot->pushMessage($userId, new TextMessageBuilder("Hai Kak {$user->display_name}, Ini adalah userid kakak: ' . $userId . ' Disimpan baik2 yah userid nya :)"));
		}

		return $result;

}