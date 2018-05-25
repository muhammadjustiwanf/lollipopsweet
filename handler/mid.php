<?php

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\GuzzleHTTPClient;

$config = [
    'channelId' => getenv('CHANNEL_ID'),
    'channelSecret' => getenv('CHANNEL_SECRET'),
    'channelMid' => getenv('CHANNEL_MID'),
];
$sdk = new LINEBot($config, new GuzzleHTTPClient($config));

$postdata = @file_get_contents("php://input");
$messages = $sdk->createReceivesFromJSON($postdata);

$sigheader = 'X-LINE-ChannelSignature';
$signature = @$_SERVER[ 'HTTP_'.strtoupper(str_replace('-','_',$sigheader)) ];
if($signature && $sdk->validateSignature($postdata, $signature)) {
    if(is_array($messages)) {
        foreach ($messages as $message) {
            if ($message instanceof LINEBot\Receive\Message\Text) {
                $text = $message->getText();
                if ($text == ".mid") {
                    $fromMid = $message->getFromMid();

                    $result = $sdk->sendText([$fromMid], 'mid: ' . $fromMid);
                    if(!$result instanceof LINE\LINEBot\Response\SucceededResponse) {
                        error_log('LINE error: ' . json_encode($result));
                    }
                } else {
                }
            } else {
            }
        }
    }
} else {
    error_log('LINE signatures didn\'t match');
}
