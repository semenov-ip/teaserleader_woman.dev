<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Get_teaser_block_data {
  public $ci, $blockId, $referer;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getTeaserBlockData($blockId, $referer){

    $this->getBlockId($blockId); $this->getReferer($referer);
    
    $blockDataObj = $this->getBlockData();

    $siteDataObj = $this->getSiteData($blockDataObj->site_id, $blockDataObj->user_id);

    $this->lastLoadSites($blockDataObj->site_id);

    $geoLocation = $this->getIpGeoBase();

    $campaignDataObj = $this->getCampaignDataObj($geoLocation);

    $this->checkUserAndCampaignDataObj($campaignDataObj);

    $teaserDataObj = $this->getTeaserDataObj($campaignDataObj, ($blockDataObj->ver*$blockDataObj->hor), $siteDataObj->ban_teaser);

    $this->checkTeaserData($teaserDataObj);

    $teaserDataObj = $this->increaseTeaserDataEnoughBlock($teaserDataObj, ($blockDataObj->ver*$blockDataObj->hor));

    $viewStyle = $this->ci->block_style_builder->getStyle($blockDataObj);

    $viewTeaser = $this->ci->show_block_preview->builderTeserBlock($teaserDataObj, $blockDataObj);

    return array( 'teaser' => $teaserDataObj, 'block' => $blockDataObj, 'view' => $viewStyle.$viewTeaser );
  }

  function getBlockId($blockId){
    $this->blockId = $blockId;
  }

  function getReferer($referer){
    $this->referer = $referer;
  }

  function getBlockData(){
    $dataWhereArr['block_id'] = $this->blockId;

    return $this->ci->select_models->select_one_row_where_column($dataWhereArr, 'blocks');
  }

  function getSiteData($siteId, $userId){
    $dataWhereArr['site_id'] = $siteId;
    $dataWhereArr['user_id'] = $userId;

    return $this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'ban_teaser', 'sites');
  }

  function lastLoadSites($siteId){
    $dataUpdateArr['last_load'] = $this->ci->config->item('date');
    $dataWhereArr['site_id'] = $siteId;

    $this->ci->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'sites');
  }

  function getIpGeoBase(){
    return $this->ci->ip_geo_base->determineLocationSite();
  }

  function getCampaignDataObj($geoLocation){
    return $this->ci->show_query->select_all_from_campaign_banlike($geoLocation, $this->referer, 'campaign_id', 'campaigns');
  }

  function checkUserAndCampaignDataObj($campaignDataObj){
    if( !is_array($campaignDataObj) ){ return $this->ci->riderConstructedDataJs(extract_key_this_array( $this->ci->config->item('error_message'), "empty_campaign")); }
  }

  function getTeaserDataObj($campaignDataObj, $limit, $banTeaser){
    return $this->ci->show_query->select_all_from_teaser_banlike($campaignDataObj, $limit, $banTeaser, 'teaser_id, user_id, campaign_id, image, text, url', 'teasers');
  }

  function checkTeaserData($teaserDataObj){
    if( !is_array($teaserDataObj) ){ return $this->ci->riderConstructedDataJs(extract_key_this_array( $this->ci->config->item('error_message'), "empty_teaser")); }
  }

  function increaseTeaserDataEnoughBlock( $teaserDataObj, $countTeaserDataObj ){
    if( count($teaserDataObj) < $countTeaserDataObj ){

      $notEnough = $countTeaserDataObj - count($teaserDataObj);

      $countTeaserDataOldObj = $teaserDataObj;

      for ($i=0; $i < $notEnough; $i++) {
        $teaserDataObj[] = $teaserDataObj[ rand( 0, (count($countTeaserDataOldObj)-1) ) ];
      }
    }
    return $teaserDataObj;
  }
}