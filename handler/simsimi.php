<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function simsimi($query, $userId){
  if ($query == null){
    $result = new TextMessageBuilder('Simsimi ada disini!\nCoba ketik .simsimi [keyword] untuk memulai percakapan.\n\nContoh: .simsimi apa kabar?\n\nSilahkan dicoba~');
  } else {

    $client = new LINEBotTiny($_ENV['CHANNEL_ACCESS_TOKEN'], $_ENV['CHANNEL_SECRET']);
    $userId 	= $client->parseEvents()[0]['source']['userId'];
    $replyToken = $client->parseEvents()[0]['replyToken'];
    $message 	= $client->parseEvents()[0]['message'];
    $profil = $client->profil($userId);
    $pesan_datang = $message['text'];

      if($message['type']=='sticker'){	
        $balas = array(
        'UserID' => $profil->userId,	
        'replyToken' => $replyToken,							
        'messages' => array(
				array(
				'type' => 'text',									
				'text' => 'Terima Kasih Stikernya.'										
									
									)
							)
						);
						
} else {
$pesan=str_replace(" ", "%20", $pesan_datang);
$key = 'd0af1ae6-6b9d-4204-9bf7-04e07afc16a9'; //API SimSimi
$url = 'http://sandbox.api.simsimi.com/request.p?key='.$key.'&lc=id&ft=1.0&text='.$pesan;
$json_data = file_get_contents($url);
$url=json_decode($json_data,1);
$diterima = $url['response'];
if($message['type']=='text')
{
if($url['result'] == 404)
	{
		$balas = array(
							'UserID' => $profil->userId,	
                                                        'replyToken' => $replyToken,													
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Mohon Gunakan Bahasa Indonesia Yang Benar :D.'
									)
							)
						);
				
	}
else
if($url['result'] != 100)
	{
		
		
		$balas = array(
							'UserID' => $profil->userId,
                                                        'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Maaf '.$profil->displayName.' Server Kami Sedang Sibuk Sekarang.'
									)
							)
						);
				
	}
	else{
		$balas = array(
							'UserID' => $profil->userId,
                                                        'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''.$diterima.''
									)
							)
						);
						
	}
}
 
$result = new TextMessageBuilder(json_encode($balas));
}
file_put_contents('./reply.json',$result);

return $result;
  }
}
