<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('webmaster_statistiq_default_data')){

  function webmaster_statistiq_default_data($key = false){
    $ci =& get_instance();

    $day = $ci->config->item('day');

    if($key !== false ) {$webmasterDefaultData[$key] = -1; }

    $webmasterDefaultData['date_start'] = date("d-m-Y", $day - 60*60*24*7);

    $webmasterDefaultData['date_end'] = date("d-m-Y", $day);

    return $webmasterDefaultData;
  }
}