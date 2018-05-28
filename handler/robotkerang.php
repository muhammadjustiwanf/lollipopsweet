<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function apakah($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu......\nCara menggunakannya:\n\n.apakah [pertanyaanmu].\nMisal: .apakah bot pintar?\n\nSelamat mencoba");
  } else {

function answers(){
    $list_jwb = array(
		'Ya',
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

    $result = new TextMessageBuilder(apakah(answers()));
  }
  return $result;
}
file_put_contents($botname.'.json',$result);
