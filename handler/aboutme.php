<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function aboutme($userId){
	
	$result = new TextMessageBuilder("© Bot Owner:\nline.me/ti/p/~m__justiwanfarnadi");
	return $result;
	
}