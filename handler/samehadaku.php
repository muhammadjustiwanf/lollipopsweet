<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($query){

$session = curl_init('"http://jurnalcode.com/");
$result = curl_exec($session);
curl_close($session);
return $result;
}