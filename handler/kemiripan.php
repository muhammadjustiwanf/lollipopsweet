<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function berapapersen($query, $userId){

  if ($query == null){
    $result = new TextMessageBuilder("><");
  } else {

    similar_text($query, $persen);
    if ($persen == null){
      $result = new TextMessageBuilder('Null');
    } else {
      $result = new TextMessageBuilder('Kemiripan: ' . $persen . ' %');
      }
    }

  return $result;

}