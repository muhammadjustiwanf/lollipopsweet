<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function apakah($inputMessage, $rt){
  if ($query == null){
    $result = new TextMessageBuilder("Puja kulit kerang ajaib ululululululu......\nCara menggunakannya:\n\n.apakah [pertanyaanmu].\nMisal: .apakah bot pintar?\n\nSilahkan dicoba");
  } else {

    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $inputMessage
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
    $reply = $send[$answrr];

    $result = new TextMessageBuilder(json_encode($reply));
  }
  return $result;
  file_put_contents($botname.'.json',$result);
}

