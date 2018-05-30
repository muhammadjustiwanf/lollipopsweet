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
 
    <!-- google map will be shown here -->
    <div id="gmap_canvas">Loading map...</div>
    <div id='map-label'>Map shows approximate location.</div>
 
    <!-- JavaScript to show google map -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDUC3p9FqzmMYgYWKiBpLcQqMddot48xyw"></script>   
    <script type="text/javascript">
        function init_map() {
            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
            });
            infowindow = new google.maps.InfoWindow({
                content: "<?php echo $formatted_address; ?>"
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);
        }
        google.maps.event.addDomListener(window, 'load', init_map);
    </script>
 
<?php

    if (isset($data_arr))
      $result = new TextMessageBuilder($data_arr);
      else
      $result = new TextMessageBuilder('Hasil dari ' . $query . ' tidak ditemukan.');
  }
	
	  return $result;

}
