<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function teach($query, $userId){

		include 'post.php';
		if ($userId != 'U45a70016f56dbfc99e6a66673002ecbe'){
				$result = new TextMessageBuilder('Akses Ditolak.');
		} else {

				if ($query == null){
						$result = new TextMessageBuilder("Ajari bot kata-kata atau keyword\n\n/teach [keyword] [jawaban] \n\njika tidak terdapat jawaban, maka secara otomatis [keyword] akan terhapus.");
				} else {

						$querySplit = explode(' ', $query, 2);
						$word = strtolower($querySplit[0]);
						$answer = $querySplit[1];

						postData('words/' . $word, $answer);

						if ($answer == null){
								$result = new TextMessageBuilder('Jawaban untuk "' . $word . '" telah dihapus.');
						} else {
								$result = new TextMessageBuilder('Terimakasih sudah mengajari bot kata2, silahkan coba ketik "' . $word . '".');
						}
				}
		}

		return $result;

}

