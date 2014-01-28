<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('incite_status_site_teaser_name')){

  function incite_status_site_teaser_name($statusNum){
    $statusName = array( 
      0 => array("name" => "На модерации", "class" => "label-warning", "icon" => "icon-minus-sign", "status" => 0),
      1 => array("name" => "Активна", "class" => "label-success", "icon" => "icon-pause", "status" => 1),
      2 => array("name" => "Приостановлена", "class" => "label-danger", "icon" => "icon-play", "status" => 2),
      3 => array("name" => "Заблокирован", "class" => "label-danger", "icon" => "icon-minus-sign", "status" => 3)
    );

    return $statusName[$statusNum];
  }
}