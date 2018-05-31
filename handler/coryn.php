<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function web(){
	
$url = "http://finance.yahoo.com/gainers?e=aq";
$raw = file_get_contents($url);

$newlines = array("\	","\
","\\r","\\x20\\x20","\\0","\\x0B");
$content = str_replace($newlines, "", html_entity_decode($raw));

$start = strpos($content,'<div id="yfitp" class="yfitabsc">');
$end = strpos($content,'<div id="yfisrtq">',$start) + 18;
$content = substr($content,$start,$end-$start);

//set search pattern (using regular expressions)
$find = '|<td class="first"><b><a href="/q?s=.*?">(.*?)</a></b></td>|is';
preg_match_all($find, $content, $matches);
$result = new TextMessageBuilder($matches);
return $result;
}
