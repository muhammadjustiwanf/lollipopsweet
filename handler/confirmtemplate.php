<?php

use \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder as ConfirmTemplateBuilder;
use \LINE\LINEBot\MesssgeBuilder\TextMessageBuilder as TextMessageBuilder;

function postmember($inputMessage){
if ($inputMessage == null){
    $result = new TextMessageBuilder('Mau memposting orang? Caranya: /postmember orang.');
} else {
    $result = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder(
   "apakah gw ganteng?",
   [
   new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('Ya',"/ya"),
   new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('Tidak','/tidak'),
   ]
   );
$templateMessage = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('nama template', $result);
$result = $bot->replyMessage($event['replyToken'], $templateMessage);
return $result->getHTTPStatus() . ' ' . $result->getRawBody();
}}
