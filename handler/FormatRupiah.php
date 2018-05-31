<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function rp($query, $userId) {

  if ($query == null){
    $result = new TextMessageBuilder("Format Rupiah Generator.\n#EdisiMiminLagiGabut😆\n\nCara menggunakan: .rp [nominal]\nContoh: .rp 1000000 (Tidak memakai titik ataupun koma pada nominal, jika dipakai maka generator akan menghasilkan nilai yang salah).\n\nSilahkan dicoba~");
  } else {
 
    if (is_numeric($query)) {
      $format_rupiah = 'Rp. ' . number_format($query, '2', ',', '.');
    }
      if ($format_rupiah == null){
        $result = new TextMessageBuilder("Gagal mengidentifikasi nominal atau ". $query . " bukan nominal yang valid!" . "\n");
      } else {
        $result = new TextMessageBuilder($format_rupiah);
        }
  }

  return $result;

}

