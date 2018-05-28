<?php
 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as  TextMessageBuilder;
 
function memeid($query, $userId){
   
    $URL = 'http://version1.api.memegenerator.net/Generators_Search';
    $apiKey = '62115028-fca1-43c3-897e-57ee3e105eaa';
   
    if ($query == null){
        $result = new TextMessageBuilder("Meme Generator\n\nCara menggunakan:\n/memeid query\n/meme 'memeid' Teks atas|Teks bawah\n\nContoh:\n/memeid Kocak\n/meme 689854 Kids zaman now|Generasi Micin.\n\nSilahkan dicoba  (((o(*ﾟ▽ﾟ*)o)))");
    } else {
 
        $query = urlencode($query);
        $URL = $URL . '?q=' . $query;
        $URL = $URL . '&apiKey=' . $apiKey;
       
        $json = file_get_contents($URL);
        $json = json_decode($json, true);
       
        $generatorID = $json['result'][0]['generatorID'];
       
        if ($generatorID == null){
            $result = new TextMessageBuilder('GeneratorID tidak ditemukan.');
        } else {
            $result = new TextMessageBuilder('GeneratorID: ' . $generatorID);
        }
       
    }
   
    return $result;
 
}