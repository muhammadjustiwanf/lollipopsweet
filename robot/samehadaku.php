<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($query){

include 'postsamehada.php';
		if ($url == null){
				$result = new TextMessageBuilder('use /samehadaku to view list update anime');
} else {

$samehadaku = samehadaku("https://www.samehadaku.tv");
$dom = new DomDocument();
$dom->loadHTML($samehadaku);
$classname="post-item tie-standard";
$finder = new DomXPath($dom);
$spaner = $finder->query("//*[contains(@class, '$classname')]");
$span = $spaner->item(0);
$link =  $span->getElementsByTagName('a');
$tanggal = $span->getElementsByTagName('span');
$no = 0;
$data =array();
foreach ($link as $val){
    $data[] = array(
        'judul' => $link->item($no)->nodeValue,
        'link' => $link->item($no)->getAttribute('href'),
        'tanggal' => $tanggal->item($no)->nodeValue,
        );
}
$result = new TextMessageBuilder($data[]);
}
return $result;
    $no++;
}
