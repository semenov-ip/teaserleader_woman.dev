<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('site_statistiq_default_data')){

  function site_statistiq_default_data(){
    $ci =& get_instance();

    $day = $ci->config->item('day');

    $campaignDefaultData['date_start'] = date("d-m-Y", strtotime(extractFirst()));

    $campaignDefaultData['date_end'] = date("d-m-Y", $day);

    $campaignDefaultData['search'] = "";

    return $campaignDefaultData;
  }
}

function extractFirst(){
  $ci =& get_instance();

  $dataWhereArr = array();

  return $ci->select_models->select_mindata_where_fromtable($dataWhereArr, 'dataadd', 'sites');
}