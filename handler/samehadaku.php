<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($url){

  if ($url == null){
      $result == new TextMessageBuilder ('Not Found');
} else {
      $data = curl_init();
      curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($data, CURLOPT_URL, $url);
      $result = curl_exec($data);
      curl_close($data);
}
      return $result;
}

$url = samehadaku('https://www.samehadaku.tv/');
$pecah = explode('<ul class="post-item tie-standard"',$url);
  if ($pecah == null){
      $result = new TextMessageBuilder('Hasil tidak ditemukan');
} else {
$result = new TextMessageBuilder($pecah[0]);
}
return $result;
