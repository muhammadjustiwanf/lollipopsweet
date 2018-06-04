<?php

use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder as ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function write($query, $userId){

  require_once 'TeksKeGambar.php';
  if ($query == null){
    $result = new TextMessageBuilder('TULIS SESUATU!');
  } else {

    $img = new TeksKeGambar;
    $text = $query;
    $img->buatGambar($text);

    $image = $img->tampilkanGambar();
    $result = new ImageMessageBuilder($image);
    }

  return $result;

}

//$img->simpanKePng('hasil-convert','gambar/');
