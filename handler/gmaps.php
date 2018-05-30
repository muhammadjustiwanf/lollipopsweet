<?php 

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
 
function geocode($address, $userId){
  if ($address == null){
    $result = new TextMessageBuilder('Jangan typo!');
  } else {
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDUC3p9FqzmMYgYWKiBpLcQqMddot48xyw";
 
    // get the json response
    $json = file_get_contents($url);
     
    // decode the json
    $jsondecode = json_decode($json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
        }
           if ($data_arr == null){
             $result = new TextMessageBuilder('Not Found data!');
           } else {
            $result = new TextMessageBuilder($data_arr);
             
    }
         
  }
            return $result;
}
}