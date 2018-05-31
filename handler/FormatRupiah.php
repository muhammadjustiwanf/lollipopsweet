<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

$angka = '1234567890';
function rp($angka) {
 
    if(is_numeric($angka)) {
        $format_rupiah = 'Rp ' . number_format($angka, '2', ',', '.');
        return $format_rupiah;
    }
    else {
        $result = new TextMessageBuilder($angka . " bukan angka yang valid!" . "\n");
    }
$result = new TextMessageBuilder(formatRupiah($angka));
return $result;
}
