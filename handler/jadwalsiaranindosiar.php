<?php

function fungsiCurl($url, $userId){
  if ($URL == null){
    $result = new TextMessageBuilder('URL Not Found!');
  } else {
     $data = curl_init();
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
}
$url = fungsiCurl('http://www.indosiar.com/jadwal-acara/');
$pecah = explode('<br /><br />', $url);
$pecah2 = explode ("</div>",$pecah[1]);
$text = strip_tags($pecah2[0]);
$result = new TextMessageBuilder($text);
return $result;
}
