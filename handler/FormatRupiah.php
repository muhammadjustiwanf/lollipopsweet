<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function rp($query, $userId) {

  if ($query == null){
    $result = new TextMessageBuilder($query . " bukan angka yang valid!" . "\n");
  } else
 
    if (is_numeric($query)) {
      $format_rupiah = 'Rp ' . number_format($query, '2', ',', '.');
      if ($format_rupiah == null){
        $result = new TextMessageBuilder('Format rupiah gagal dikonversi');
      } else {
      $result = new TextMessageBuilder($format_rupiah);
      }
    }
    return $result;
}
