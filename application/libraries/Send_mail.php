<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Send_mail {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function sendMailMessage($userEmail, $subject, $text, $from){

    $headers = "Content-type: text/html; charset=utf-8 \r\n"
    ."From: =".'?UTF-8?B?'.base64_encode($from).'?='." <".$from."> \r\n";

    $status = mail($userEmail, $subject, $text, $headers);
  }
}