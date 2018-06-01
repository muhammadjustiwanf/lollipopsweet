<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function tanggal($userId){
	
	$result = new TextMessageBuilder(date('j-F-Y'));
	return $result;
	
}