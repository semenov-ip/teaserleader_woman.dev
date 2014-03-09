<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Settings extends CI_Controller{

  private $who, $purse;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('execute_trim_empty_form');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->library('_shared/validation_data_settings');

    $userDataObj = $this->getUserData();

    $data = template_builder('admin','admin_settings_tpl', $this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['userDataObj'] = empty($_POST) ? $userDataObj : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserData(){
    $dataWhereArr['hash'] = extract_key_this_array($this->session->userdata('user'), 'hash');

    return $this->cleanAddDataInput($this->select_models->select_one_row_where_column($dataWhereArr, 'users'));
  }

  function cleanAddDataInput($dataUserObj){
    $this->purse = $dataUserObj->purse;

    return $dataUserObj;
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataSettingsUpdate();
  }

  function getPostDataSettingsUpdate(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_settings->getCorrectData($this->purse);

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->updateDataUserProfile($_POST)){

        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/_shared/settings/", 'location');
      }
    }

    return false;
  }

  function updateDataUserProfile($post){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'users');
  }
}