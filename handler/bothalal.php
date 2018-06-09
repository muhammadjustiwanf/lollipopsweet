<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function produk($query, $userId){
	
	include 'line_class.php';
	include 'unirest-php-master/src/Unirest.php';
	date_default_timezone_set('Asia/Jakarta');
	
	$URL = 'https://sites.google.com/macros/exec';
	$appkey = 'AKfycbx_-gZbLP7Z2gGxehXhWMWDAAQsTp3e3bmpTBiaLuzSDQSbIFWD';
	
	if ($query == null){
		$result = new TextMessageBuilder("(((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?service=' . $appkey;
		$URL = $URL . '&menu=' . 'nama_produk';
		$URL = $URL . '&query=' . $query;

		$response = Unirest\Request::get("$URL");
		$json = json_decode($response->raw_body, true);
		$json = array();
		$jsonFound = array_push($json,
				$json['data']['title'],
				$json['data']['nomor_sertifikat'],
				$json['data']['produsen'],
				$json['data']['berlaku_hingga']
		));
		
		if ($jsonFound = 'error'){
			$result = new TextMessageBuilder('Produk ' . $query . ' tidak ditemukan. Ngetik yang bener yak, jangan typo! :v');
		} else {
			$result = new TextMessageBuilder("Hasil pencarian dengan nama produk " . strtoupper(urldecode($query)) . ":\nTanggal: " . date('j F Y') . "\n\n\n" . $jsonFound("\n\n\n") . "\n\n\nDiakses pada pukul: " . date('H:i:s'));
				
				}
		
		}
	
	return $result;

}

