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

     $data = curl_init();
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
     $result = curl_exec($data);
     curl_close($data);
     return $result;
}

$url = cuaca('https://www.samehadaku.tv/');
$pecah = explode('ul',{'class':'post-item tie standard'},$url);
$result = new TextMessageBuilder($pecah2[0]);
return $result;
