<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function server($query, $userId){

  $host = $query;
  $port = 80;
  if (!$socket = @fsockopen($host, $port, $errno, $errstr, 30)){
    $result = new TextMessageBuilder($host . ' Sedang Down');
  } else {
    $result = new TextMessageBuilder($host . ' Online');
  fclose($socket);
    }
  return $result;
}