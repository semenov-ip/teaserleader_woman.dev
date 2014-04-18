<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('incite_status_ticket_name')){

  function incite_status_ticket_name($statusNum){
    $statusName = array( 
      0 => array("name" => "В обработке", "class" => "label-warning"),
      1 => array("name" => "Получен ответ", "class" => "label-success"),
      2 => array("name" => "Просмотрен пользователем", "class" => "label-success"),
      3 => array("name" => "Закрыт пользователем", "class" => "label-default"),
      4 => array("name" => "Закрыт администратором", "class" => "label-default"),
    );

    return $statusName[$statusNum];
  }
}