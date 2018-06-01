<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function tanggal($userId){
	
	date_default_timezone_set('Asia/Jakarta');
	$result = new TextMessageBuilder(date('\T\a\n\g\g\a\l: j F Y, \J\a\m: H:i:s.'));
	return $result;
	
}