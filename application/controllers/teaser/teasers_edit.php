<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teasers_edit extends CI_Controller {

  private $who, $teaserId, $campaignId, $image;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($teaserId){
    $this->load->helper('execute_trim_empty_form');
    $this->load->helper('select_define_builder');
    $this->load->helper('convert_data_string_this_db');
    $this->load->helper('convert_data_array_this_db');
    $this->load->helper('setup_array_noisset_data');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->library('image_upload');
    $this->load->library('teaser/validation_data_teaser_and_builder_collection');
    $this->load->library('teaser/data_builder_teaser_html_elements');

    $this->getTeaserId($teaserId);

    $teaserDataObj = $this->getTeaserData();

    $data = template_builder('admin','teasers_add_update_tpl', $this->who, 'teasers');

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'teaser_edit_title' );

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['teaserDataObj'] = empty($_POST) ? $teaserDataObj : (object)$_POST;

    $data = $this->data_builder_teaser_html_elements->data($data);

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

  function checkDataImplementCurrentTeaser($teaserDataObj){
    if(is_object($teaserDataObj)){

      $teaserDataObj = convert_data_array_this_db($teaserDataObj, array('section_id'));

      $this->campaignId = $teaserDataObj->campaign_id;

      $this->image = $teaserDataObj->image;

      return $teaserDataObj;
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataTeaserEdit();
  }

  function getPostDataTeaserEdit(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_teaser_and_builder_collection->getCorrectData($this->campaignId, isset($_FILES['image']['type']), false);

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
    unset($post['image_name']);

    $dataWhereArr['teaser_id'] = $this->teaserId;

    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $post = convert_data_string_this_db($post, array('section_id'));

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'teasers');
  }
}