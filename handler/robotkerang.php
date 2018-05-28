<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function apakah($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu......\nCara menggunakannya:\n\n.apakah [pertanyaanmu].\nMisal: .apakah bot pintar?\n\nSilahkan dicoba");
  } else {

    $answerslist = array(
		'Iya',
		'Kalo diliat2 lagi sih iya',
		'Bisa jadi',
		'Mungkin',
		'Tidak',
		'Coba tanya lagi',
    'Benar',
    'hoax'
		);
    $answr = array_rand($answerslist);
    $answrr = $answerslist[$answr];

    $result = new TextMessageBuilder($answrr);
  }
  return $result;
  file_put_contents($botname.'.json',$result);
}

