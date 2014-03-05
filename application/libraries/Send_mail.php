<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Send_mail {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function sendMailMessage($userEmail, $subject, $text){

    $subject = '=?UTF-8?B?'.trim(@imap_binary($subject)).'?=';

    $headers = "Content-type: text/html; charset=UTF-8 \r\n"
        ."From: =".'?UTF-8?B?'.base64_encode('Ladyads').'?='." <support@ladyads.ru> \r\n";

    return mail($userEmail, $subject, $text, $headers);
  }
}