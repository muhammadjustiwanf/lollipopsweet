<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function email($query, $userId){

/*
  if ($query == null){
    $result = new TextMessageBuilder('MAIL');
  } else {
*/

    $to = "mjustiwanf2@gmail.com";
    $subject = "Test";
    $isi = "TEST";
 
    if (mail($to, $subject, $isi)){
	    $result = new TextMessageBuilder('Email terkirim.');
    } else {
	    $result = new TextMessageBuilder('Terjadi kesalahan, email tidak terkirim.');
      }

  return $result;

}

