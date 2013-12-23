<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Check_campaign_blocks_id_current_user {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function checkCampaign($campaignId){
    $dataWhereArr['campaign_id'] = $campaignId;
    $dataWhereArr['user_id'] = extract_key_this_array($this->ci->session->userdata('user'), 'user_id');

    $this->haveDataQuery($dataWhereArr, 'campaigns');
  }

  function checkBlocks($siteId){
    $dataWhereArr['site_id'] = $siteId;
    $dataWhereArr['user_id'] = extract_key_this_array($this->ci->session->userdata('user'), 'user_id');

    $this->haveDataQuery($dataWhereArr, 'sites');
  }

  function haveDataQuery($dataWhereArr, $dbTableName){
    if ( !$this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'user_id', $dbTableName) ){
      redirect( "/_shared/user_distributor/", 'location');
    }
  }
}