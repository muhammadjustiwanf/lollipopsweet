<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function status($url, $userId){{

     $data = curl_init();
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
	 //curl_setopt($data,	CURLOPT_AUTOREFERER, true);
     curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
     $hasil = curl_exec($data);
     curl_close($data);
}
$url = fungsiCurl('http://www.vsi.esdm.go.id/');
  if (url == null){
    $result = new TextMessageBuilder('URL Tidak ditemukan.');
  } else {
    $pecah = explode('<div class="module module_long">', $url);
    $pecah2 = explode ('</div><!-- #wrapper-content-right -->',$pecah[1]);
    $result = new TextMessageBuilder($pecah2[0]);
    }

  return $result;

}