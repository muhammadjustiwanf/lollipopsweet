<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($data){
if (data == null){
$result = new TextMessageBuilder('Not Found');
} else {

$session = curl_init('"https://www.samehadaku.tv");
$result = new TextMessageBuilder(curl_exec($session));
curl_close($session);
}
return $result;
    }