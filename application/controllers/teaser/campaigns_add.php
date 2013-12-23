<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Campaigns_add extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('template_builder');
    $this->load->helper('trim_stripslashes');
    $this->load->helper('extract_key_this_array');
    $this->load->helper('select_define_builder');
    $this->load->helper('checkbox_table_builder');
    $this->load->helper('setup_array_empty_data');
    $this->load->helper('setup_array_noisset_data');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library($this->who.'/data_builder_campaign_html_elements');
    $this->load->library($this->who.'/validation_data_campaig_and_builder_collection');

    $data = template_builder('admin','campaigns_add_update_tpl', $this->who);

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'campaign_add_title' );

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataCampaignAdd() );

    $data['campaignDataObj'] = empty($_POST) ? (object)$this->getCampaignKey() : (object)$_POST;

    $data = $this->data_builder_campaign_html_elements->data($data);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getCampaignKey(){
    return $this->setUpDefaultsValue($this->select_models->show_columns('campaigns'));
  }

  function setUpDefaultsValue($campaignDataObj){
    $campaignDataObj = setup_array_empty_data( $campaignDataObj, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day') );

    return $campaignDataObj;
  }

  function getPostDataCampaignAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_campaig_and_builder_collection->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->saveDataCollectionCampaign($_POST);
    }

    return false;
  }

  function saveDataCollectionCampaign($post){
    $this->load->helper('convert_data_string_this_db');

    $post = convert_data_string_this_db($post, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

    $post['dataadd'] = $this->config->item('datetime');

    $post['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $campaignId = $this->insert_models->insert_data_return_id($post, 'campaigns');

    if($campaignId){
      redirect( "/_shared/user_distributor/", 'location');
    }
  }
}