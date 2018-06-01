<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function sayhbd($query, $userId){
	
	$result = new TextMessageBuilder('Ciee2 yang ultah ' . strtoupper($query) . ' makan2 lah 😂 gak makan2 gw posting lu ' . $query . ' 😆');
	return $result;
	
}