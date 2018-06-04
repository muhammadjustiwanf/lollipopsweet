<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function writehbdto($query, $userId){
	
	$result = new TextMessageBuilder('WOI ' . strtoupper($query) . ' ultah ciekk 😂 makan2 lah, gak makan2 gw posting lu ' . strtolower($query) . ' 😆');
	return $result;
	
}