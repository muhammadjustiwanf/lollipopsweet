<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function bacaHTML($url){

//mengambil data dari kompas 

$bacaHTML = bacaHTML("http://www.kompas.com");


//membuat dom dokumen

$dom = new DomDocument();


//mengambil html dari kompas untuk di parse

$dom->loadHTML($bacaHTML);


//nama class yang akan dicari

$classname="latest__wrap";


//mencari class memakai dom query

$finder = new DomXPath($dom);

$spaner = $finder->query("//*[contains(class, '$classname')]");


//mengambil data dari class yang pertama

$span = $spaner->item(0);


//dari class pertama mengambil 2 elemen yaitu a yang menyimpan judul dan link dan span yang menyimpan tanggal

$link =  $span->getElementsByTagName('a');

$tanggal = $span->getElementsByTagName('span');


$no = 0;


//persiapkan array untuk diambil datanya

$data =array();

foreach ($link as $val){ 

    $data[] = array(

        'judul' => $link->item($no)->nodeValue,

        'link' => $link->item($no)->getAttribute('href'),

        'tanggal' => $tanggal->item($no)->nodeValue,

        );

    $no++;
$result = new TextMessageBuilder($data);
}
return $result;
}