<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($userId){

$html = file_get_contents("http://www.programminghelp.com/");
 
preg_match_all(
    '/<h2><a href="(.*?)" rel="bookmark" title=".*?">(.*?)<\/a><\/h2>/s',
    $html,
    $posts
);
 
foreach ($posts as $post) {
    $link = $post[1];
    $title = $post[2];
$result = new TextMessageBuilder($link, $title);
}
return $result;
}