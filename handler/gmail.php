<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function gmail($userId){
/*
  if ($query == null){
    $result = new TextMessageBuilder('GMAIL');
  } else {
*/
    $email    = "mjustiwanf6@gmail.com";
    $password = "AfternoonTalk27051998";
  //$query = $email, $password;
 
    $imap_host = "{<a class="vglnk" href="http://imap.gmail.com" rel="nofollow"><span>imap</span><span>.</span><span>gmail</span><span>.</span><span>com</span></a>:993/imap/ssl}";
 
    $imap_folder = "INBOX";

    $mailbox = imap_open($imap_host . $imap_folder,$email,$password);
    if ($mailbox == null){
      $result = new TextMessageBuilder('Gagal membuka koneksi ke GMail: ' . imap_last_error());
    }
 
      $emails = imap_search($mailbox, 'ALL');
 
      rsort($emails);
        if( $emails ){
          foreach( $emails as $email_id){
            $email_info = imap_fetch_overview($mailbox,$email_id,0);
            $message = imap_fetchbody($inbox,$email_number,2);
          }
            if ($emails == null){
              $result = new TextMessageBuilder('Terjadi error.');
            } else {         
            $result = new TextMessageBuilder (("Subject: " . $email_info[0]->subject . "\r\n"), "Message: " . $message . "\n");
              }
        }

  return $result;

}

