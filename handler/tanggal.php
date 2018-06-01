<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function tanggal($userId){
	
	$result = new TextMessageBuilder(date("→Tanggal = j F Y\n→Jam = H:i:s"));
	return $result;
	
}