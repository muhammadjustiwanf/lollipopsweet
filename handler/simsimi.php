<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function simsimi($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder('Simsimi ada disini!\nCoba ketik .simsimi [keyword] untuk memulai percakapan.\n\nContoh: .simsimi apa kabar?\n\nSilahkan dicoba~');
  } else {

      if($message['type']=='sticker'){	
          $result = new TextMessageBuilder('Terimakasih stikernya :)');

} else {
$pesan=str_replace(" ", "%20", $query);
$key = '26d4b177-b900-4f68-8099-0d2c02252d1a'
$url = 'http://sandbox.api.simsimi.com/request.p?key='.$key.'&lc=id&ft=1.0&text='.$pesan;
$json_data = file_get_contents($url);
$url=json_decode($json_data, true);
$diterima = $url['response'];
  if($message['type']=='text'){
    if($url['result'] == 404){
      $result = new TextMessageBuilder('Harap gunakan bahasa yang dapat dimengerti, jangan pakek bahasa alien :v');
    } else {
      if($url['result'] != 100){
      $result = new TextMessageBuilder('Maaf '.$profil['displayName'].' Server Kami Sedang Sibuk Sekarang.
    } else {
      $result = new TextMessageBuilder($diterima);
	  }
  }
      $result = new TextMessageBuilder(json_encode($balas));
      file_put_contents('./reply.json',$result);
      }
      return $result;
    }
