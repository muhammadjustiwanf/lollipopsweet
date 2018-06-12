<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function memeid($query, $userId){
	
	$URL = 'http://version1.api.memegenerator.net/Generators_Search';
	$apiKey = '62115028-fca1-43c3-897e-57ee3e105eaa';
	
	if ($query == null){
		$result = new TextMessageBuilder("~Meme Generator~\n\nCara menggunakan: .memeid [search]\nContoh: .memeid Spongebob\n\nSecara Otomatis bot akan mengirimkan Generator IDnya. Copas ID tersebut dan input ke meme maker.\n\nSilahkan paste id tersebut ke Meme Maker. ketik .keyword atau .help lalu pilih 'Meme Maker'.\n\nSilahkan dicoba~ (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?q=' . $query;
		$URL = $URL . '&apiKey=' . $apiKey;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);
		
		$generatorID = $json['result'][0]['generatorID'];
		
		if ($generatorID == null){
			$result = new TextMessageBuilder('GeneratorID tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder('GeneratorID: ' . $generatorID);
		}
		
	}
	
	return $result;

}
