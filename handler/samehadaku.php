<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($userId){

  include 'PHPHtmlParser/Dom';
  include 'Sunra/PhpSimple/HtmlDomParser';
  if ($userId == null){
    $result = new TextMessageBuilder('SUNRA not');
  } else {

    $dom  = new Dom;
    $url  = $dom->loadFromUrl('http://blog.mitschool.co.id/belajar-ionic-framework/');
    $html = $url->outerHtml;
    $html = HtmlDomParser::str_get_html($html);

    $content = $html->find('div.single-blog-content', 0)->innertext;
    $publishDate = $html->find('meta[property=article:published_time]', 0)->content;

    foreach ($html->find('a[rel=category tag]') as $val) :
	    $category[] = strtolower($val->plaintext);
endforeach;

      $data = [
	'publish_at' => date("Y-m-d", strtotime($publishDate)),
	'title'      => $html->find('h1', 0)->plaintext,
	'img'        => $html->find('img.size-full', 0)->src,
	'content'    => $content,
	'author'	 => $html->find('div.blog-meta a[title]', 0)->plaintext,
	'category'	 => $category,

];

    $result = new TextMessageBuilder($data);

  }

  return $result;

}