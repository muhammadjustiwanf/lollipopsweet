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

    $answerslist = array(
		'Ya',
		'Iya',
		'Bisa jadi',
		'Mungkin',
		'Benar',
		'Coba tanya lagi'
		);
    $answr = array_rand($answerslist);
    $answrr = $answerslist[$answr];
    $balas = $send, $answrr;

    $result = new TextMessageBuilder(json_encode($balas));
  }
  return $result;
  file_put_contents($botname.'.json',$result);
}

