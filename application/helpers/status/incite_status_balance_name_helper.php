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
}