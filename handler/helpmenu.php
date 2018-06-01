<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function help($userId){
	
	$result = new TextMessageBuilder("~List command yang tersedia~\n>USE [.] for prefix.<\nUntuk bantuan bagaimana cara menggunakannya, cukup ketik salah satu command yang ingin kamu pilih dibawah ini lalu *send* maka bot akan mengirimkan pesan bantuannya ^^\n\n→ .userid\n→ .instagram\n→ .calculate\n→ .meme\n→ .xkcd\n→ .teach\n→ .apakah (Kerang ajaib)\n→ .corynitem\n→ .rp\n→ .tanggal\n→ .server\n\nSilahkan dicoba (*^▽^*)");
	return $result;
	
}
