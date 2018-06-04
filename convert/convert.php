<?php

use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder as ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function write($query, $userId){
  
  include 'TeksKeGambar.php';
  if ($query == null){
    $result = new TextMessageBuilder('TULIS SESUATU!');
  } else {

    $img = new TeksKeGambar;
    $text = $query;
    $img->buatGambar($text);

    $image = $img->tampilkanGambar();
    if ($image == null){
      $result = new TextMessageBuilder('Error');
    } else {
    $result = new ImageMessageBuilder($image);
    $img->simpanKePng('hasil-convert','gambar/');
      }
    }

  return $result;

}
