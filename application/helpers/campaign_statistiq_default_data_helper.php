<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('campaign_statistiq_default_data')){

  function campaign_statistiq_default_data(){
    $ci =& get_instance();

    $day = $ci->config->item('day');

    $campaignDefaultData['date_start'] = date("d-m-Y", strtotime(extractFirst()));

    $campaignDefaultData['date_end'] = date("d-m-Y", $day);

    $campaignDefaultData['sorter_by'] = 'desc';

    $campaignDefaultData['sorter_column'] = 'ctr';

    return $campaignDefaultData;
  }
}

function extractFirst(){
  $ci =& get_instance();

  $dataWhereArr['user_id'] = extract_key_this_array($ci->session->userdata('user'), 'user_id');

  return $ci->select_models->select_mindata_where_fromtable($dataWhereArr, 'dataadd', 'campaigns');
}