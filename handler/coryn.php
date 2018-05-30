<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function corynlv($query, $userId){
	
	$URL = 'http://coryn.club/leveling.php';
	
	if ($query == null){
		$result = new TextMessageBuilder(".corynlv [level]\n\nSilahkan dicoba  (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?lv=' . $query;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);
		
		$hasil = $json['result'][0]['hasil'];
		
		if ($hasil == null){
			$result = new TextMessageBuilder('GeneratorID tidak ditemukan.');
		} else {
			$result = new TextMessageBuilder('GeneratorID: ' . $hasil);
		}
		
	}
	
	return $result;

}
