<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$botname = "robotkerangdb";

function dimana($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder("Ini bukan kerang ajaib, kalo kerang ajaib yang satunya :v\nCara menggunakannya:\n\n.dimana [pertanyaanmu].\nMisal: .dimana kamu tadi melihat dia?\n\nSilahkan dicoba");
  } else {

    $answerslist = array(
		'di sayidan',
		'dinamo',
		'di tato',
		'di tytyd',
		'di puskud',
		'dimana aja',
    'di lampu merah',
    'di goa'
		);
    $answr = array_rand($answerslist);
    $answrr = $answerslist[$answr];

    $result = new TextMessageBuilder($answrr);
  }
  return $result;
  file_put_contents($botname.'.json',$result);
}

