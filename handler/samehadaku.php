<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function youtube($userId){

    $url = file_get_contents('https:// www.youtube.com/feed/trending');

    $videos = [];
    $i = 1;
    foreach ($url->find('li.expanded-shelf-content-item-wrapper') as $video) {
      if ($i > 10) {
              break;
      }

      $videoDetails = $video->find('a.yt-uix-tile-link', 0);

      $videoTitle = $videoDetails->title;

      $videoUrl = 'https://youtube.com' . $videoDetails->href;

      $videos[] = [
                'title' => $videoTitle,
                'url' => $videoUrl
      ];

      $i++;

      $result = new TextMessageBuilder($videos);
    }
      return $result;
}
