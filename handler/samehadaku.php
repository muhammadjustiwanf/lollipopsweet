<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$url = 'http://samehadaku.tv/';

function samehadaku($url){

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $result = new TextMessageBuilder(curl_exec($ch)); 
    curl_close($ch);  
    return $result;
}