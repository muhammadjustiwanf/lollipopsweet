<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($query){

$session = curl_init("https://www.samehadaku.tv/");
$result = new TextMessageBuilder (curl_exec($session));
curl_close($session);
return $result;
}