<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function server($query, $userId){

	if ($query == null){
		$result = new TextMessageBuilder("~Server Checker~\n#EdisiGabut😂\n\nCommand ini dibuat dalam kondisi mimin yang lagi gabut 😆. Command ini berfungsi untuk mengecek suatu server website apakah sedang down/off atau online.\nCara menggunakan: .server [web]\nContoh: .server www.youtube.com\n\nSilahkan dicoba~ 😄");
	} else {

		$host = $query;
		$port = 80;
			if (!$socket = @fsockopen($host, $port, $errno, $errstr, 30)){
				$result = new TextMessageBuilder($host . ' Sedang Down');
			} else {
				$result = new TextMessageBuilder($host . ' Online');
				fclose($socket);
				}
		}

	return $result;

}