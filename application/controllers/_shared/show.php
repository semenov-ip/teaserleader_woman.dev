<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller{
  public $blockId, $referer;


  function __construct(){
    parent::__construct();
  }

  function index($blockId){
    $this->load->helper('referer_url_extract');
    $this->load->library('/_shared/validation_data_show');
    $this->load->library('_shared/ip_geo_base');
    $this->load->model('show/show_query');
    $this->load->model('select_models');
    $this->load->model('update_models');

    $this->getBlockId($blockId); $this->getReferer();

    $submitStatus = $this->validation_data_show->getCorrectData($this->blockId, $this->referer);

    if( $submitStatus !== true ){ return $this->riderConstructedDataJs(extract_key_this_array( $this->config->item('error_message'), $submitStatus)); }

    $blockDataObj = $this->getBlockData();

    $siteDataObj = $this->getSiteData($blockDataObj->site_id, $blockDataObj->user_id);

    $this->lastLoadSites($blockDataObj->site_id);

    $geoLocation = $this->getIpGeoBase();

    $campaignDataObj = $this->getCampaignDataObj($geoLocation);

    $this->checkUserAndCampaignDataObj($campaignDataObj);

    $teaserDataObj = $this->getTeaserDataObj($campaignDataObj, $siteDataObj->ban_teaser);

    return $this->riderConstructedDataJs(print_r($teaserDataObj));
  }

  function getBlockId($blockId){
    $this->blockId = $blockId;
  }

  function getReferer(){
    $this->referer = referer_url_extract($_SERVER['HTTP_REFERER']);
  }

  function getBlockData(){
    $dataWhereArr['block_id'] = $this->blockId;

    return $this->select_models->select_one_row_where_column($dataWhereArr, 'blocks');
  }

  function getSiteData($siteId, $userId){
    $dataWhereArr['site_id'] = $siteId;
    $dataWhereArr['user_id'] = $userId;

    return $this->select_models->select_one_row_where_column($dataWhereArr, 'sites');
  }

  function lastLoadSites($siteId){
    $dataUpdateArr['last_load'] = $this->config->item('date');
    $dataWhereArr['site_id'] = $siteId;

    $this->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'sites');
  }

  function getIpGeoBase(){
    return $this->ip_geo_base->determineLocationSite();
  }

  function getCampaignDataObj($geoLocation){
    return $this->show_query->select_all_from_campaign_banlike($geoLocation, $this->referer, 'campaign_id', 'campaigns');
  }

  function checkUserAndCampaignDataObj($campaignDataObj){
    if( !is_array($campaignDataObj) ){ return riderConstructedDataJs(extract_key_this_array( $this->config->item('error_message'), "empty_campaign")); }
    // Дописать на проверку баланса
  }

  function getTeaserDataObj($campaignDataObj, $banTeaser){
    return $this->show_query->select_all_from_teaser_banlike($campaignDataObj, $banTeaser, 'teaser_id, user_id, campaign_id, image, text', 'teasers');
  }

  function riderConstructedDataJs($text){
    echo 'var block = document.getElementById(\'teaser_'.$this->blockId.'\'); var text = \''.$text.'\'; if(block){block.innerHTML = text;}';
  }

}