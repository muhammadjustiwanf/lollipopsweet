<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function tanggal(){
	
	$result = new TextMessageBuilder(date('j-F-Y'));
	return $result;
	
}