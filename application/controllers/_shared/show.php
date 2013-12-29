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
    $this->load->library('_shared/get_teaser_block_data');
    $this->load->library('block_style_builder');
    $this->load->library('show_block_preview');
    $this->load->model('show/show_query');
    $this->load->model('select_models');
    $this->load->model('update_models');

    $this->getBlockId($blockId); $this->getReferer();

    $submitStatus = $this->validation_data_show->getCorrectData($this->blockId, $this->referer);

    if( $submitStatus !== true ){ return $this->riderConstructedDataJs(extract_key_this_array( $this->config->item('error_message'), $submitStatus)); }

    $teaserBlockDataObj = $this->get_teaser_block_data->getTeaserBlockData($this->blockId, $this->referer);

    return $this->riderConstructedDataJs($teaserBlockDataObj['view']);
  }

  function getBlockId($blockId){
    $this->blockId = $blockId;
  }

  function getReferer(){
    $this->referer = referer_url_extract($_SERVER['HTTP_REFERER']);
  }

  function riderConstructedDataJs($text){
    echo 'var block = document.getElementById(\'teaser_'.$this->blockId.'\'); var text = \''.$text.'\'; if(block){block.innerHTML = text;}';
    exit();
  }

}