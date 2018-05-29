<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function translate($query, $userId){

  include 'yandex.php';
  if ($query == null){
    $result = new TextMessageBuilder('Jangan typo!');
  } else {

$yandex = new Yandex();
$result = new TextMessageBuilder($yandex->translate('id-en','Selamat pagi semuanya'));
}
return $result;
}
