<?php


function userid($query, $userId){
	
	if ($userId == null){
		$result = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Kita belum berteman, ' . $profil->displayName . '. Add bot dulu gih :v'
									
									)
							)
						);
	} else {
		
		$result = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'userid ' . $profil->displayName . ': ' . $userId
									
									)
							)
						);
	}
	
		if (isset($result)){
			$result = json_encode($result);
								
			$client->replyMessage($result);

		}
}
