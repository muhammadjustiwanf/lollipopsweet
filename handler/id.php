<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
use \LINE\LINEBot\Response;

$response = $bot->getProfile('userId');
if ($response->isSucceeded()) {
    $profile = $response->getJSONDecodedBody();
    $displayName = $profile['displayName'];
    $pictureUrl = $profile['pictureUrl'];
    $statusMessage = $profile['statusMessage'];
}

function userid($query, $userId){

		if ($userId == null){
				$result = new TextMessageBuilder('Kita belum berteman kak, add dulu gih :v');
				} else {
				$result = new TextMessageBuilder('Hai kak ' . $displayName . ' Ini adalah userid kakak: ' . $userId);
		}

		return $result;

}