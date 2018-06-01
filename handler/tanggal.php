<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function tanggal($userId){
	
	date_default_timezone_set('Asia/Jakarta');
	$result = new TextMessageBuilder(date("Tanggal: j F Y Jam: H:i:s"));
	return $result;
	
}