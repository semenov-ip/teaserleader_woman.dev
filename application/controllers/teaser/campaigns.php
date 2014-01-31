<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Campaigns extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->helper('return_word_end');
    $this->load->helper('get_define_day');
    $this->load->helper('campaign_statistiq_default_data');

    $data = template_builder('admin','campaigns_tpl', $this->who);

    $data['campaignDataObj'] = $this->getCampaignData();

    $data['statistiqData'] = empty($_POST) ? $this->getFormDataDefault() : $_POST;

    $data['defineDay'] = get_define_day();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getCampaignData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'campaign_id, name, status', 'campaigns'));
  }

  function setDataProcessing($campaignDataObj){
    if(is_array($campaignDataObj)){

      foreach ($campaignDataObj as $key => $currentCampaignDataObj) {

        $campaignDataObj[$key]->playStatus = $currentCampaignDataObj->status == 0 ? "disabled" : "onclick=\"playPauseElement('".$currentCampaignDataObj->campaign_id."', 'campaign_id', '".$currentCampaignDataObj->status."', 'campaigns');\"";

        $currentCampaignDataObj->status = incite_status_site_teaser_name($currentCampaignDataObj->status);

        $campaignDataObj[$key]->countTeaser = return_word_end($this->select_models->select_count_where_fromtable(array('campaign_id' => $currentCampaignDataObj->campaign_id), 'teasers'), 'объявлен', 'ие', 'ия', 'ий');

      }

      return $campaignDataObj;
    }

    return false;
  }

  function getFormDataDefault(){
    return campaign_statistiq_default_data();
  }
}