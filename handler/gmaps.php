<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
use \LINE\LINEBot\ImagemapActionBuilder\AreaBuilder as AreaBuilder;

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

    if ($json['status']=='OK'){
      $lati = isset($json['results'][0]['geometry']['location']['lat']) ? $json['results'][0]['geometry']['location']['lat'] : "";
      $longi = isset($json['results'][0]['geometry']['location']['lng']) ? $json['results'][0]['geometry']['location']['lng'] : "";
      $formatted_address = isset($json['results'][0]['formatted_address']) ? $json['results'][0]['formatted_address'] : "";
    
      if($lati && $longi && $formatted_address){
    
        $data_arr = array();            
             
        array_push(
            $data_arr, 
                $lati, 
                $longi, 
                $formatted_address
            );
             
        return $data_arr;

      } else {
        return false;
      }
    } else

        if($_POST){

          $data_arr = maps($_POST['address']);
            if($data_arr){
         
              $latitude = $data_arr[0];
              $longitude = $data_arr[1];
              $formatted_address = $data_arr[2];
            }
        }

?>

<!doctype html>
<html>
    <head>
        <title>Google Maps API - harviacode.com</title>
        <!--1. Memanggil google Maps API-->
        <script src="http://maps.googleapis.com/maps/api/js"></script>
 
        <script>
            // 2. menambahkan properti peta
            function initialize() {
                var properti_peta = {
                    center: new google.maps.LatLng(-6.3145891999999995, 106.9596627),
                    zoom: 8,
                    mapTypeId: google.maps.MapTypeId.SATELITE
                };
                // 4. membuat object peta
                var peta = new google.maps.Map(document.getElementById("tempat_peta"), properti_peta);
            }
            // 5. menampilkan peta
            google.maps.event.addDomListener(window, 'load', initialize);
 
        </script>
    </head>
    <body>
        <!--3. membuat div untuk menampilkan peta-->
        <div id="tempat_peta" style="width:500px;height:300px;"></div>
    </body>
</html>
 
<?php

    if (isset($data_arr))
      $result = new AreaBuilder($data_arr);
      else
      $result = new TextMessageBuilder('Hasil dari ' . $query . ' tidak ditemukan.');
  }
	
	  return $result;

}
