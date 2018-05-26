<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$url = 'https://www.samehadaku.net/';

function samehadaku($query){

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec($ch); 
    curl_close($ch);
}      
    return $result;
}