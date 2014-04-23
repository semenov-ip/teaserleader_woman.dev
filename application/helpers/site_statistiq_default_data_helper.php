<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('site_statistiq_default_data')){

  function site_statistiq_default_data(){
    $ci =& get_instance();

    $day = $ci->config->item('day');

    $siteDefaultData['date_start'] = date("d-m-Y", strtotime(extractFirst()));

    $siteDefaultData['date_end'] = date("d-m-Y", $day);

    $siteDefaultData['search'] = "";

    $siteDefaultData['sorter_by'] = 'desc';

    $siteDefaultData['sorter_column'] = 'ctr';

    return $siteDefaultData;
  }
}

function extractFirst(){
  $ci =& get_instance();

  $dataWhereArr = array();

  return $ci->select_models->select_mindata_where_fromtable($dataWhereArr, 'dataadd', 'sites');
}