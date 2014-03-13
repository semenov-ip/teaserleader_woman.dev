<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Teasers_add extends CI_Controller{

  private $who, $campaignId;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($campaignId){
    $this->load->helper('execute_trim_empty_form');
    $this->load->helper('select_define_builder');
    $this->load->helper('convert_data_string_this_db');
    $this->load->helper('setup_array_empty_data');
    $this->load->helper('setup_array_noisset_data');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('image_upload');
    $this->load->library('check_campaign_blocks_id_current_user');
    $this->load->library('teaser/validation_data_teaser_and_builder_collection');
    $this->load->library('teaser/data_builder_teaser_html_elements');

    $this->check_campaign_blocks_id_current_user->checkCampaign($campaignId);

    $this->getCampaignId($campaignId);

    $data = template_builder('admin','teasers_add_update_tpl', $this->who, 'teasers');

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'teaser_add_title' );

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataTeaserAdd() );

    $data['teaserDataObj'] = empty($_POST) ? (object)$this->getTeaserKey() : (object)$_POST;

    $data = $this->data_builder_teaser_html_elements->data($data);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getCampaignId($campaignId){
    $this->campaignId = $campaignId;
  }

  function getTeaserKey(){
    return $this->setUpDefaultsValue($this->select_models->show_columns('teasers'));
  }

  function setUpDefaultsValue($teaserDataObj){
    return setup_array_empty_data( $teaserDataObj, array('section_id') );
  }

  function getPostDataTeaserAdd(){
    if(!empty($_POST)){

      $_POST['image'] = !empty($_POST['image_name']) ? $_POST['image_name'] : null;

      $submitStatus = $this->validation_data_teaser_and_builder_collection->getCorrectData($this->campaignId, !empty($_FILES['image']['type']));

      if( isset($_POST['image']) ){ $_POST['image_name'] = $_POST['image']; }

      if( $submitStatus !== true ){ return $submitStatus; }

      return $this->saveDataCollectionTeaser($_POST);
    }

    return false;
  }

  function saveDataCollectionTeaser($post){
    unset($post['image_name']);

    $post['campaign_id'] = $this->campaignId;

    $post['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $post['dataadd'] = $this->config->item('datetime');

    $post = convert_data_string_this_db($post, array('section_id'));

    $teaserId = $this->insert_models->insert_data_return_id($post, 'teasers');

    if($teaserId){
      $this->session->set_flashdata('successSaveUpdateData', 'success_save_data');

      redirect( "/teaser/teasers/index/$this->campaignId/", 'location');
    }
  }
}