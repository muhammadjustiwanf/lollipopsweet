<?php

include 'yandex.php';

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function translate($query, $userId){

  if ($query == null){
    $result = new TextMessageBuilder('Jangan typo!');
/*
  } else {

    $yandex = new Yandex();
    $query = $yandex->translate;

    $result = new TextMessageBuilder($query);
*/
  }

return $result;

}
