<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function pass($query, $userId){

  if ($query == null){
    $result = new TextMessageBuilder("~Password Generator~\n\nCara menggunakan: .pass [input password]\nContoh: .pass golden\n\nSilahkan dicoba~");
  } else {

    for ($p = 0; $p < 10; $p++){
    $string .= $query[mt_rand(0, $ps)];
    }
      if ($string == null){
        $result = new TextMessageBuilder('Error atau ' . $query . ' tidak valid!');
      } else {
        $result = new TextMessageBuilder($string);
        }
    }

  return $result;

}

