<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('incite_status_site_teaser_name')){

  function incite_status_site_teaser_name($statusNum){
    $statusName = array( 
      0 => array("name" => "На модерации", "class" => "label-warning"),
      1 => array("name" => "Приостановлена", "class" => "label-danger"),
      2 => array("name" => "Активна", "class" => "label-succes")
    );

    return $statusName[$statusNum];
  }
}