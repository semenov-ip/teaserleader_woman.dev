<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller{
  public $blockId, $referer;

  function __construct(){
    parent::__construct();
  }

  function index($blockId){
    $this->load->helper('referer_url_extract');
    $this->load->helper('country_extratc_column_name_view');
    $this->load->helper('extract_key_this_object');
    $this->load->helper('trim_stripslashes');
    $this->load->helper('convert_data_array_this_db');
    $this->load->library('/_shared/validation_data_show');
    $this->load->library('_shared/ip_geo_base');
    $this->load->library('_shared/get_teaser_block_data');
    $this->load->library('_shared/logsave_count_statistiques');
    $this->load->library('block_style_builder');
    $this->load->library('show_block_preview');
    $this->load->library('idna_convert');
    $this->load->model('show/show_query');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->model('insert_models');

    $this->getBlockId($blockId); $this->getReferer();

    $submitStatus = $this->validation_data_show->getCorrectData($this->blockId, $this->referer);

    if( $submitStatus !== true ){ return $this->riderConstructedDataJs(extract_key_this_array( $this->config->item('error_message'), $submitStatus)); }

    $teaserBlockDataObj = $this->get_teaser_block_data->getTeaserBlockData($this->blockId, $this->referer);

    return $this->riderConstructedDataJs($teaserBlockDataObj['view'], $teaserBlockDataObj);
  }

  function getBlockId($blockId){
    if(!isset($blockId)){ $this->userDistributor(); }

    $this->blockId = $blockId;
  }

  function getReferer(){
    if(!isset($_SERVER['HTTP_REFERER'])){ $this->userDistributor(); }

    $this->referer = referer_url_extract($_SERVER['HTTP_REFERER']);
  }

  function riderConstructedDataJs($text, $teaserBlockDataObj = false){

    if( $this->checkTeaserBlock($teaserBlockDataObj) ){ $this->logsave_count_statistiques->saveDataLogAndStat($teaserBlockDataObj['teaser'], $teaserBlockDataObj['block']); }

    $siteId = isset($teaserBlockDataObj['block']->site_id) ? $teaserBlockDataObj['block']->site_id : false;

    echo 'var block = document.getElementById(\'teaser_'.$this->blockId.'\'); var text = \''.$this->codingData($text, $siteId).'\'; if(block){block.innerHTML = text;}';

    exit();
  }

  function checkTeaserBlock($teaserBlockDataObj){
    if( is_array($teaserBlockDataObj['teaser']) && is_object($teaserBlockDataObj['block']) ){ return true; }

    return false;
  }

  function codingData($text, $siteId){
    if($siteId){
      $urlEncoding = extract_key_this_object($this->getUrlEncoding($siteId), "url_encoding");

      return iconv('utf-8', $urlEncoding, $text);
    }

    return $text;
  }

  function getUrlEncoding($siteId){
    $dataWhereArr['site_id'] = $siteId;

    return $this->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'url_encoding', 'sites');
  }

  function userDistributor(){
    redirect( "/_shared/user_distributor/", 'location');
  }
}