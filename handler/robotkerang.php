<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function apakah($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu......\nCara menggunakannya:\n\n.apakah [pertanyaanmu].\nMisal: .apakah bot pintar?\n\nSilahkan dicoba");
  } else {

    $answerslist = array(
		"Ya",
		"Iya",
		"Bisa jadi",
		"Mungkin",
		"Benar",
		"Coba tanya lagi"
		);
    $answr = array_rand($answerslist);
    $answrr = $answerslist[$answr];

    $result = new TextMessageBuilder(json_encode($answrr));
  }
  return $result;
  file_put_contents($botname.'.json',$result);
}

