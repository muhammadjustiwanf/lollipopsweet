<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function achanimelyric($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	$URL = 'http://www.achanime.net/megumi-kato-cv-kiyono-yasuno-eternal♭-lyrics/';
	
	if ($query == null){
		$result = new TextMessageBuilder("Hmm... Cuaca hari ini mendung, cerah, atau hujan yah? Nih, bot bisa memberi tahu kamu prediksi cuaca di kota kamu lho..😆 Caranya cukup mudah, yuk cek dengan cara:\n\nKetik: .prediksicuaca [kota]\nContoh: .prediksicuaca Jakarta\n\nKarena ini prediksi, jadi tidak 100% akurat yah ^^\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		
		if ($response == null){
			$result = new TextMessageBuilder('Error atau hasil pencarian tidak ditemukan. Silahkan coba lagi~');
		} else {
			$result = new TextMessageBuilder($json['div']['p']);
			}
		
		}
	
	return $result;

}

