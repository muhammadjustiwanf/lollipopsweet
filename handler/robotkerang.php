<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function apakah($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu......\nCara menggunakannya:\n\n.apakah [pertanyaanmu].\nMisal: .apakah bot pintar?\n\nSilahkan dicoba");
  } else {

    $send = array(
        'userId' => $userId,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $query
            )
        )
    );
    return($send);

    $list_jwb = array(
		'Ya',
		'Iya',
		'Bisa jadi',
		'Mungkin',
		'Benar',
		'Coba tanya lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    $jawablagi = json_encode($jawab);

    $result = new TextMessageBuilder($jawablagi);
  }
  return $result;
  file_put_contents($botname.'.json',$result);
}

