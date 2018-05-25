<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function roomId($query, $roomId){

		if ($roomId == null){
				$result = new TextMessageBuilder('Room Id tidak ditemukan.');
		} else {
				$result = new TextMessageBuilder('Ini dia roomId nya: ' . $roomId);
		}

		return $result;

}