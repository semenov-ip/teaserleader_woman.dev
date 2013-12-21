<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaigns_edit extends CI_Controller {

  private $who, $campaignId;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($campaignId){
    $this->load->helper('template_builder');
    $this->load->helper('trim_stripslashes');
    $this->load->helper('extract_key_this_array');
    $this->load->helper('select_define_builder');
    $this->load->helper('checkbox_table_builder');
    $this->load->helper('convert_data_array_this_db');
    $this->load->helper('convert_data_string_this_db');
    $this->load->helper('setup_array_noisset_data');
    $this->load->model('select_models');
    $this->load->model('update_models');

    $this->getCampaignId($campaignId);

    $data = template_builder('admin','campaigns_add_update_tpl', $this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'campaign_edit_title' );

    $data['campaignDataObj'] = empty($_POST) ? $this->getCampaignData() : (object)$_POST;

    $data['selectChangeSection'] = select_define_builder(array($data['campaignDataObj']->section_id), $this->getSectionKeyIdValueName(), true);

    $data['selectChangeBanCountrys'] = select_define_builder($data['campaignDataObj']->ban_country, $this->getBanCountrysKeyIdValueName(), true);

    $data['selectChangeBanRegions'] = select_define_builder($data['campaignDataObj']->ban_region, $this->getBanRegionsKeyIdValueName());

    $data['checkboxCheckedBanHour'] = checkbox_table_builder($data['campaignDataObj']->ban_hour, $this->getBanHourKeyIdValueName(), 3, 'ban_hour');

    $data['checkboxCheckedBanWeekDay'] = checkbox_table_builder($data['campaignDataObj']->ban_week_day, $this->getBanWeekDayKeyIdValueName(), 2, 'ban_week_day', true);

    $data['selectChangeLabels'] = select_define_builder(array($data['campaignDataObj']->labels), $this->getLabelsKeyIdValueName(), true);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getCampaignId($campaignId){
    $this->campaignId = $campaignId;
  }

  function getCampaignData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $dataWhereArr['campaign_id'] = $this->campaignId;

    return $this->checkDataImplementCurrentCampaign($this->select_models->select_one_row_where_column($dataWhereArr, 'campaigns'));
  }

  function checkDataImplementCurrentCampaign($campaignDataObj){
    if(is_object($campaignDataObj)){ 
      $campaignDataObj = convert_data_array_this_db($campaignDataObj, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

      return $campaignDataObj; 
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataCampaignEdit();
  }

  function getSectionKeyIdValueName(){
    return $this->select_models->select_all_row_selectcolumn_return_key_value('section_id, section_name', 'section_id', 'section_name', 'sections');
  }

  function getBanCountrysKeyIdValueName(){
    return $this->select_models->select_all_row_selectcolumn_return_key_value_orderby('country, country_name', 'country', 'country_name', 'asc', 'ipgeobase');
  }

  function getBanRegionsKeyIdValueName(){
    $dataWhereArr['country'] = "RU";

    return $this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'region', 'asc', 'ipgeobase');
  }

  function getLabelsKeyIdValueName(){
    return array( '_utm'=> 'Utm', '_openstat' => 'Openstat', '_from' => 'From', '_subid' => 'SubID' );
  }

  function getBanHourKeyIdValueName(){
    for($i=0; $i < 24; $i++){
      $banHour[] = $i;
    }

    return $banHour;
  }

  function getBanWeekDayKeyIdValueName(){
    return $this->config->item('daysWeek');
  }

  function getPostDataCampaignEdit(){
    if(!empty($_POST)){

      $_POST = trim_stripslashes($_POST, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

      $_POST = setup_array_noisset_data($_POST, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

      if( $this->nameCleanCheckEmptyInputData() ) return "empty_name";

      if( $this->issetSubidNotSubid() ) return "empty_subid";

      if($this->updateDataCollectionCampaign($_POST)){
        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/tiser/campaigns_edit/index/$this->campaignId/", 'location');
      }
    }

    return false;
  }

  function nameCleanCheckEmptyInputData(){
    if( empty($_POST['name']) ) { return true; }

    return false;
  }

  function issetSubidNotSubid(){
    if( $_POST['labels'] == "_subid" && empty($_POST['subid']) ){
      return true;
    }

    return false;
  }

  function updateDataCollectionCampaign($post){
    $post = convert_data_string_this_db($post, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

    $dataWhereArr['campaign_id'] = $this->campaignId;
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'campaigns');
  }
}