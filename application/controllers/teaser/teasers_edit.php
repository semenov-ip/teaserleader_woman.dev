<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teasers_edit extends CI_Controller {

  private $who, $teaserId, $campaignId, $image;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($teaserId){
    $this->load->helper('execute_trim_empty_form');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->library('image_upload');
    $this->load->library('teaser/validation_data_teaser_and_builder_collection');

    $this->getTeaserId($teaserId);

    $teaserDataObj = $this->getTeaserData();

    $data = template_builder('admin','teasers_add_update_tpl', $this->who, 'teasers');

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'teaser_edit_title' );

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['teaserDataObj'] = empty($_POST) ? $teaserDataObj : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTeaserId($teaserId){
    $this->teaserId = $teaserId;
  }

  function getTeaserData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $dataWhereArr['teaser_id'] = $this->teaserId;

    return $this->checkDataImplementCurrentTeaser($this->select_models->select_one_row_where_column($dataWhereArr, 'teasers'));
  }

  function checkDataImplementCurrentTeaser($campaignDataObj){
    if(is_object($campaignDataObj)){

      $this->campaignId = $campaignDataObj->campaign_id;

      $this->image = $campaignDataObj->image;

      return $campaignDataObj;
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataTeaserEdit();
  }

  function getPostDataTeaserEdit(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_teaser_and_builder_collection->getCorrectData($this->campaignId, isset($_FILES['image']['type']));

      if( !isset($_POST['image']) ){ $_POST['image'] = $this->image; }

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->updateDataCollectionTeaser($_POST)){

       $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

       redirect( "/teaser/teasers_edit/index/$this->teaserId/", 'location');
      }
    }

    return false;
  }

  function updateDataCollectionTeaser($post){
    $dataWhereArr['teaser_id'] = $this->teaserId;
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'teasers');
  }
}