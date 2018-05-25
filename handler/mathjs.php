<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function calculate($query) {

		if ($query == null){
     $result = new TextMessageBuilder("Untuk cara menggunakan kalkulator, ketik /calculate 'nominal'\n\nContoh: /calculate 5+5*5-5\n\nSelamat mencoba (((o(*ﾟ▽ﾟ*)o)))");
		} else {
		$query = urlencode($query);
		$result = file_get_contents('http://api.mathjs.org/v4/?expr=' . $query);
		$result = new TextMessageBuilder($result);

		return $result;

		}

}

