<?php


function teach($query, $userId){

	include 'line_class.php';
	include 'post.php';
	if ($userId != 'U45a70016f56dbfc99e6a66673002ecbe'){
		$result = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => "Akses dari " . $profil->displayName . " Ditolak!\nHanya admin yang dapat menggunakan command ini."
									
									)
							)
						);
	} else {

		if ($query == null){
			$result = array(
								'replyToken' => $replyToken,														
								'messages' => array(
									array(
											'type' => 'text',									
											'text' => "Ajari bot kata-kata atau keyword dengan cara:\n\n.teach [keyword] [jawaban] \n\njika tidak terdapat jawaban, maka secara otomatis [keyword] akan terhapus."
										
										)
								)
							);
		} else {

			$querySplit = explode(' ', $query, 2);
			$word = strtolower($querySplit[0]);
			$answer = $querySplit[1];

			postData('words/' . $word, $answer);

			if ($answer == null){
				$result = array(
									'replyToken' => $replyToken,														
									'messages' => array(
										array(
												'type' => 'text',									
												'text' => 'Jawaban untuk "' . $word . '" telah dihapus.'
									
									)
							)
						);
			} else {
				$result = array(
									'replyToken' => $replyToken,														
									'messages' => array(
										array(
												'type' => 'text',									
												'text' => 'Terimakasih sudah mengajari bot kata2 / keyword, silahkan coba ketik "' . $word . '".'
									
									)
							)
						);
			}

		}
	}

	$client->replyMessage($result);

}

