<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder("Hai Kak {$user->display_name} Kita belum berteman, add dulu gih :v");
		} else {
				$result = new TextMessageBuilder("Hai Kak {$user->display_name} Ini adalah userId kakak: ' . $userId . ' Disimpan baik2 yah userid nya :)");
		}

		return $result;

}