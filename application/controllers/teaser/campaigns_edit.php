<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaigns_edit extends CI_Controller {

  private $who, $campaignId;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($campaignId){
    $this->load->helper('trim_stripslashes');
    $this->load->helper('select_define_builder');
    $this->load->helper('checkbox_table_builder');
    $this->load->helper('convert_data_array_this_db');
    $this->load->helper('convert_data_string_this_db');
    $this->load->helper('setup_array_noisset_data');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->library('/teaser/data_builder_campaign_html_elements');
    $this->load->library('/teaser/validation_data_campaig_and_builder_collection');

    $this->getCampaignId($campaignId);

    $data = template_builder('admin','campaigns_add_update_tpl', $this->who);

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'campaign_edit_title' );

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['campaignDataObj'] = empty($_POST) ? $this->getCampaignData() : (object)$_POST;

    $data = $this->data_builder_campaign_html_elements->data($data);

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

  function getPostDataCampaignEdit(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_campaig_and_builder_collection->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->updateDataCollectionCampaign($_POST)){
        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/teaser/campaigns_edit/index/$this->campaignId/", 'location');
      }
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