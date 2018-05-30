<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function help($query, $userId){
	
	$result = new TextMessageBuilder("~List command yang tersedia~\nUSE [.] for prefix.\n\n.userid\n.instagram\n.calculate\n.meme\n.xkcd\n.teach\n\nSilahkan dicoba (*^▽^*)");
	return $result;
	
}