<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('incite_status_balance_name')){

  function incite_status_balance_name($statusNum){
    $statusName = array( 
      0 => array("name" => "В обработке", "class" => "label-warning"),
      1 => array("name" => "Завершена", "class" => "label-success"),
      2 => array("name" => "Отклонен", "class" => "label-danger")
    );

    return $statusName[$statusNum];
  }

  function status_balance_name_key_value(){
    return array( 
      -1 => "Все",
      0 => "В обработке",
      1 => "Завершена",
      2 => "Отклонен"
    );
  }
}