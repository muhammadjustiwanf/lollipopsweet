<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function help($userId){
	
	$result = new TextMessageBuilder(("~List command yang tersedia~\nUSE [.] for prefix.\n\nUntuk bantuan bagaimana cara menggunakannya, cukup ketik salah satu command yang ingin kamu pilih dibawah ini lalu *send* maka bot akan mengirimkan pesan bantuannya ^^\n\n→ .userid\n→ .instagram\n→ .calculate\n→ .meme\n→ .xkcd\n→ .teach\n→ .apakah (Kerang ajaib)\n→ .corynitem\n→ .rp\n→ .tanggal\n→ .server\n\nSilahkan dicoba (*^▽^*)"), 'Oiya bot hampir kelupaan. Dari beberapa command diatas ada yang tidak memerlukan bantuan. Jadi, silahkan dicoba. Dah itu aja 😅');

	return $result;
	
}
