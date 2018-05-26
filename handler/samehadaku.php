<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function samehadaku($url){

    // inisialisasi CURL

    $data = curl_init();

    // setting CURL

    curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($data, CURLOPT_URL, $url);

    // menjalankan CURL untuk membaca isi file

    $hasil = curl_exec($data);

    curl_close($data);

    return $hasil;

}

//mengambil data dari kompas 

$samehadaku = samehadaku("https://www.samehadaku.tv");


//membuat dom dokumen

$dom = new DomDocument();


//mengambil html dari kompas untuk di parse

@$dom->loadHTML($samehadaku);


//nama class yang akan dicari

$classname="post-item tie-standard";


//mencari class memakai dom query

$finder = new DomXPath($dom);

$spaner = $finder->query("//*[contains(@class, '$classname')]");


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
$result = new TextMessageBuilder($data[]);
return $result;
    $no++;

}
