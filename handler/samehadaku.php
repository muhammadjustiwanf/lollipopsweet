<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;
/*
function samehadaku($query){

$session = curl_init("https://www.samehadaku.tv/");
$result = new TextMessageBuilder (curl_exec($session));
curl_close($session);
return $result;
}
*/

function cuaca($url){
if ($url == null){
$result = new TextMessageBuilder('Not Found');
} else {
     $data = curl_init();
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
     $result = new TextMessageBuilder (curl_exec($data));
     curl_close($data);
     return $result;
}
$url = cuaca('http://www.bmkg.go.id/BMKG_Pusat/Informasi_Cuaca/Prakiraan_Cuaca/Prakiraan_Cuaca_Indonesia.bmkg');
$pecah = explode('<h1>Prakiraan Cuaca Indonesia</h1>',$url);
$result = new TextMessageBuilder($pecah2[0]);
return $result;
}