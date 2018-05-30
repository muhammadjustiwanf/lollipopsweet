<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function gmaps($query, $userId){
	
	$URL = 'https://maps.googleapis.com/maps/api/geocode/json';
	$apiKey = 'AIzaSyDUC3p9FqzmMYgYWKiBpLcQqMddot48xyw';
	
	if ($query == null){
		$result = new TextMessageBuilder("Meme Generator\n\nCara menggunakan:\n.memeid query\n.meme 'memeid' Teks atas|Teks bawah\n\nContoh:\n.memeid Kocak\n/meme 689854 Kids zaman now|Generasi Micin.\n\nSilahkan dicoba  (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?address=' . $query;
		$URL = $URL . '&apiKey=' . $apiKey;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);

    if($json['status']=='OK'){
 
      $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
      $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
      $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

        if($lati && $longi && $formatted_address){
         
          $data_arr = array();            
             
          array_push(
              $data_arr, 
                  $lati, 
                  $longi, 
                  $formatted_address
              );
             
	  	if ($data_arr == null){
	  		$result = new TextMessageBuilder('false');
		  } else {
			  $result = new TextMessageBuilder($data_arr);
        }
	  }
	}
 }
	
	  return $result;

}
