<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function gmaps($query, $userId){
	
	$URL = 'https://maps.googleapis.com/maps/api/geocode/json';
	$apiKey = 'AIzaSyDUC3p9FqzmMYgYWKiBpLcQqMddot48xyw';
	
	if ($query == null){
		$result = new TextMessageBuilder("Google Maps Api.\n\nCara menggunakan: .gmaps [lokasi]\nMisal: .gmaps bandar lampung, kedaton.\n\nSilahkan dicoba (((o(*ﾟ▽ﾟ*)o)))");
	} else {

		$query = urlencode($query);
		$URL = $URL . '?address=' . $query;
		$URL = $URL . '&apiKey=' . $apiKey;
		
		$json = file_get_contents($URL);
		$json = json_decode($json, true);

    if ($json['status'] == 'OK'){
 
      $lati = isset(json['results'][0]['geometry']['location']['lat']) ? $json['results'][0]['geometry']['location']['lat'] : "";
      $longi = isset($json['results'][0]['geometry']['location']['lng']) ? $json['results'][0]['geometry']['location']['lng'] : "";
      $formatted_address = isset($json['results'][0]['formatted_address']) ? $json['results'][0]['formatted_address'] : "";

      if ($lati && $longi && $formatted_address){
         
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
