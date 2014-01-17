<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('webmaster_statistiq_default_data')){

  function webmaster_statistiq_default_data($key){
    $ci =& get_instance();

    $day = $ci->config->item('day');

    return array(
      $key => -1,
      'date_start' => date("d-m-Y", $day - 60*60*24*7),
      'date_end' => date("d-m-Y", $day)
    );
  }
}