<?php

use \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder as ConfirmTemplateBuilder;
use \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder as MessageTemplateActionBuilder;
use \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder as TemplateMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function postmember($inputMessage){
if ($inputMessage == null){
    $result = new TextMessageBuilder('Mau memposting orang? Caranya: /postmember orang.');
} else {
    if ($inputMessage = billy){
    $template = new ConfirmTemplateBuilder(
   "Posting billy?",
   [
   new MessageTemplateActionBuilder('Ya',"/ya"),
   new MessageTemplateActionBuilder('Tidak','/tidak'),
   ]
   );
}
$templateMessage = new TemplateMessageBuilder('nama template', $template);
$result = $bot->replyMessage($event['replyToken'], $templateMessage);
}
return $result;
}
