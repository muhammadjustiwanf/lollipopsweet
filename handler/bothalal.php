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
		
		if (isset($json['error']))
			$result = new TextMessageBuilder('Produk ' . $query . ' tidak ditemukan. Ngetik yang bener yak, jangan typo! :v');
		else
			$result = new TextMessageBuilder("Hasil pencarian dengan nama produk " . strtoupper(urldecode($query)) . ":\nTanggal: " . date('j F Y') . "\n\n\n1.  Nama Produk: " . $json['data']['0']['title'] . "\n     Nomor Sertifikat: " . $json['data']['0']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['0']['produsen'] . "\n     Berlaku hingga: " . $json['data']['0']['berlaku_hingga'] . "\n\n\n2.  Nama Produk: " . $json['data']['1']['title'] . "\n     Nomor Sertifikat: " . $json['data']['1']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['1']['produsen'] . "\n     Berlaku hingga: " . $json['data']['1']['berlaku_hingga'] . "\n\n\n3.  Nama Produk: " . $json['data']['2']['title'] . "\n     Nomor Sertifikat: " . $json['data']['2']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['2']['produsen'] . "\n     Berlaku hingga: " . $json['data']['2']['berlaku_hingga'] . "\n\n\n4.  Nama Produk: " . $json['data']['3']['title'] . "\n     Nomor Sertifikat: " . $json['data']['3']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['3']['produsen'] . "\n     Berlaku hingga: " . $json['data']['3']['berlaku_hingga'] . "\n\n\n5.  Nama Produk: " . $json['data']['4']['title'] . "\n     Nomor Sertifikat: " . $json['data']['4']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['4']['produsen'] . "\n     Berlaku hingga: " . $json['data']['4']['berlaku_hingga'] . "\n\n\n6.  Nama Produk: " . $json['data']['5']['title'] . "\n     Nomor Sertifikat: " . $json['data']['5']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['5']['produsen'] . "\n     Berlaku hingga: " . $json['data']['5']['berlaku_hingga'] . "\n\n\n7.  Nama Produk: " . $json['data']['6']['title'] . "\n     Nomor Sertifikat: " . $json['data']['6']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['6']['produsen'] . "\n     Berlaku hingga: " . $json['data']['6']['berlaku_hingga'] . "\n\n\n8.  Nama Produk: " . $json['data']['7']['title'] . "\n     Nomor Sertifikat: " . $json['data']['7']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['7']['produsen'] . "\n     Berlaku hingga: " . $json['data']['7']['berlaku_hingga'] . "\n\n\n9.  Nama Produk: " . $json['data']['8']['title'] . "\n     Nomor Sertifikat: " . $json['data']['8']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['8']['produsen'] . "\n     Berlaku hingga: " . $json['data']['8']['berlaku_hingga'] . "\n\n\n10. Nama Produk: " . $json['data']['9']['title'] . "\n     Nomor Sertifikat: " . $json['data']['9']['nomor_sertifikat'] . "\n     Produsen: " . $json['data']['9']['produsen'] . "\n     Berlaku hingga: " . $json['data']['9']['berlaku_hingga'] . "\n\n\nDiakses pada pukul: " . date('H:i:s'));
		
		}
	
	return $result;

}

