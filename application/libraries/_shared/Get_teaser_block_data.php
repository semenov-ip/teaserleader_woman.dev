<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Get_teaser_block_data {
  public $ci, $blockId, $referer;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getTeaserBlockData($blockId, $referer){

    $this->getBlockId($blockId); $this->getReferer($referer);

    $geoLocation = $this->getIpGeoBase();

    $blockDataObj = $this->addCountryBlockObj($this->getBlockData(), $geoLocation);

    $siteDataObj = $this->getSiteData($blockDataObj->site_id, $blockDataObj->user_id);

    $this->lastLoadSites($blockDataObj->site_id);

    $campaignDataObj = $this->getCampaignDataObj($blockDataObj->user_id, $geoLocation);

    $this->checkUserAndCampaignDataObj($campaignDataObj);

    $teaserDataObj = $this->getTeaserDataObj($campaignDataObj, $siteDataObj->section_id, ($blockDataObj->ver*$blockDataObj->hor), $siteDataObj->ban_teaser);

    $this->checkTeaserData($teaserDataObj);

    $teaserDataObj = $this->hashTeaserDataAdd($this->increaseTeaserDataEnoughBlock($teaserDataObj, ($blockDataObj->ver*$blockDataObj->hor)));

    $viewStyle = $this->ci->block_style_builder->getStyle($blockDataObj, '_'.$blockDataObj->block_id);

    $viewTeaser = $this->ci->show_block_preview->builderTeserBlock($teaserDataObj, $blockDataObj, '_'.$blockDataObj->block_id);

    return array( 'teaser' => $teaserDataObj, 'block' => $blockDataObj, 'view' => $viewStyle.$viewTeaser );
  }

  function getBlockId($blockId){
    $this->blockId = $blockId;
  }

  function getReferer($referer){
    $this->referer = $referer;
  }

  function getIpGeoBase(){
    return $this->ci->ip_geo_base->determineLocationSite();
  }

  function getBlockData(){
    $dataWhereArr['block_id'] = $this->blockId;
    $dataWhereArr['status'] = 1;

    return $this->checkEmptyBlockData($this->ci->select_models->select_one_row_where_column($dataWhereArr, 'blocks'));
  }

  function checkEmptyBlockData($blockData){
    if(is_object($blockData)){ return $blockData; }

    return $this->ci->riderConstructedDataJs(extract_key_this_array( $this->ci->config->item('error_message'), "empty_block"));
  }

  function addCountryBlockObj($blockDataObj, $geoLocation){
    $blockDataObj->country = $geoLocation['country'];

    return $blockDataObj;
  }

  function getSiteData($siteId, $userId){
    $dataWhereArr['site_id'] = $siteId;
    $dataWhereArr['user_id'] = $userId;
    $dataWhereArr['status'] = 1;

    return $this->checkEmptySiteData($this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'ban_teaser, section_id', 'sites'));
  }

  function checkEmptySiteData($siteData){
    if( is_object($siteData) ){ return $siteData; }

    return $this->ci->riderConstructedDataJs(extract_key_this_array( $this->ci->config->item('error_message'), "empty_site"));
  }

  function lastLoadSites($siteId){
    $dataUpdateArr['last_load'] = $this->ci->config->item('date');
    $dataWhereArr['site_id'] = $siteId;

    $this->ci->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'sites');
  }

  function getCampaignDataObj($userId, $geoLocation){
    $dataWhereArr = array( 'userip' => sprintf('%u', ip2long(getenv("REMOTE_ADDR"))), 'user_id' => $userId );

    $geoLocation = $this->ci->select_models->selectcolumn_limit_where_return_boolean($dataWhereArr, 'userip_id', 1, 'userip') ? false : $geoLocation;

    return $this->ci->show_query->select_all_from_campaign_banlike(array(), $geoLocation, $this->referer, 'campaign_id', 'campaigns');
  }

  function checkUserAndCampaignDataObj($campaignDataObj){
    if( !is_array($campaignDataObj) ){ return $this->ci->riderConstructedDataJs(extract_key_this_array( $this->ci->config->item('error_message'), "empty_campaign")); }
  }

  function getTeaserDataObj($campaignDataObj, $sectionId, $limit, $banTeaser){
    return $this->ci->show_query->select_all_from_teaser_banlike_orderby($campaignDataObj, $sectionId, 'last_show', 'asc', $limit, $banTeaser, 'teaser_id, section_id, user_id, campaign_id, image, text, url', 'teasers');
  }

  function checkTeaserData($teaserDataObj){
    if( !is_array($teaserDataObj) ){ 
      return $this->ci->riderConstructedDataJs(extract_key_this_array( $this->ci->config->item('error_message'), "empty_teaser")); 
    }
  }

  function increaseTeaserDataEnoughBlock( $teaserDataObj, $countTeaserDataObj ){
    if( count($teaserDataObj) < $countTeaserDataObj ){

      $notEnough = $countTeaserDataObj - count($teaserDataObj);

      $countTeaserDataOldObj = $teaserDataObj;

      for ($i=0; $i < $notEnough; $i++) {
        $teaserDataObj[] = clone $countTeaserDataOldObj[ mt_rand( 0, (count($countTeaserDataOldObj)-1) ) ];
      }
    }
    return $teaserDataObj;
  }

  function hashTeaserDataAdd($teaserDataObj){

    foreach ($teaserDataObj as $key => $oneTeaserDataObj) {

      $oneTeaserDataObj->hash = md5($oneTeaserDataObj->teaser_id.time().mt_rand());

      $oneTeaserDataObj->url = "http://".$_SERVER['SERVER_NAME']."/_shared/click/index/".$oneTeaserDataObj->hash."/";

      $teaserDataObjNew[] = $oneTeaserDataObj;
    }

    return $teaserDataObjNew;
  }
}