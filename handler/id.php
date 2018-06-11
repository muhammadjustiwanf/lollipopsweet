<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function userid($query, $userId){
	
	if ($userId == null){
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Ketik .userid di kolom chat!'
									
									)
							)
						);
	} else {
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'userid ' . $profil->displayName . ': ' . $userId
									
									)
							)
						);
	}
	
		if (isset($balas)){
			$hasil = json_encode($balas);
								
			$client->replyMessage($balas);
	
}
