<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function youtube($userId){

// Create DOM from URL or file
$html = file_get_html('https://www.youtube.com/feed/trending');

// creating an array of elements
$videos = [];

// Find top ten videos
$i = 1;
foreach ($html->find('li.expanded-shelf-content-item-wrapper') as $video) {
        if ($i > 10) {
                break;
        }

        // Find item link element
        $videoDetails = $video->find('a.yt-uix-tile-link', 0);

        // get title attribute
        $videoTitle = $videoDetails->title;

        // get href attribute
        $videoUrl = 'https://youtube.com' . $videoDetails->href;

        // push to a list of videos
        $videos[] = [
                'title' => $videoTitle,
                'url' => $videoUrl
        ];

        $i++;

$result = new TextMessageBuilder($videos);
}
return $result;
}