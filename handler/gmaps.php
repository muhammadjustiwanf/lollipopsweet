<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function maps($query, $userId){
	
	$URL = 'https://maps.googleapis.com/maps/api/geocode/json';
	$apiKey = 'AIzaSyDUC3p9FqzmMYgYWKiBpLcQqMddot48xyw';
	
	if ($query == null){
		$result = new TextMessageBuilder("Google Maps Api.\n\nCara menggunakan: .maps [lokasi]\nMisal: .maps bandar lampung, kedaton.\n\nSilahkan dicoba (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?address=' . $query;
		$URL = $URL . '&key=' . $apiKey;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);
 
    $lati = $json['results'][0]['geometry']['location']['lat'];
    $longi = $json['results'][0]['geometry']['location']['lng'];
    $formatted_address = $json['results'][0]['formatted_address'];

    $data = array( 
                $lati, 
                $longi, 
                $formatted_address
            );
    $dataa = array_push($data);
    $hasil = $data[$dataa];

    if (isset($hasil))
      $result = new TextMessageBuilder($hasil);
      else
      $result = new TextMessageBuilder('Hasil dari ' . $query . ' tidak ditemukan.');
  }
	
	  return $result;

}
