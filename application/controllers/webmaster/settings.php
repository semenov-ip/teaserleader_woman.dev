<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Settings extends CI_Controller{

  private $who, $userId, $top10Login, $curr_num;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('execute_trim_empty_form');
    $this->load->helper('template_builder');
    $this->load->helper('extract_key_this_array');
    $this->load->model('select_models');
    $this->load->model('update_models');

    $userDataObj = $this->getUserData();

    $data = template_builder('admin','settings_tpl', $this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['userDataObj'] = empty($_POST) ? $userDataObj : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserData(){
    $dataWhereArr['hash'] = extract_key_this_array($this->session->userdata('user'), 'hash');

    return $this->cleanAddAataInput($this->select_models->select_one_row_where_column($dataWhereArr, 'users'));
  }

  function cleanAddAataInput($dataUserObj){
    $this->userId = $dataUserObj->user_id;

    $this->curr_num = $dataUserObj->curr_num;

    $this->top10Login = $dataUserObj->top10_login;

    $dataUserObj->curr_num = is_null($dataUserObj->curr_num) ? "R" : $dataUserObj->curr_num;

    return $dataUserObj;
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveData') ? $this->session->flashdata('successSaveData') : $this->getPostDataSettingsUpdate();
  }

  function getPostDataSettingsUpdate(){
    if(!empty($_POST)){

      $_POST = $this->top10LoginPartyNoDelenKey($_POST);

      if( !execute_trim_empty_form( $_POST, array('notshow_top10_login') ) ) return "empty_data";

      if( !$this->webmoneyDoubleSaveError($_POST['curr_num']) ) return "webmoney_double_save";

      if( !$this->webmoneyInputError($_POST['curr_num']) ) return "webmoney_input_error";

      if($this->updateDataUserProfile($_POST)){

        $this->session->set_flashdata('successSaveData', 'success_save_data');

        redirect( "/webmaster/settings/", 'location');
      }
    }

    return false;
  }

  function top10LoginPartyNoDelenKey($post){

    if( !isset($_POST['notshow_top10_login']) ){

      $post['notshow_top10_login'] = 0;
      
      return $post;
    }

    $post['top10_login'] = empty($this->top10Login) ? $post['name'] : $this->top10Login;

    return $post;
  }

  function webmoneyInputError($wmr){
    if(substr($wmr, 0, 1) != 'R' || strlen($wmr) != 13){
      return false;
    }
    return true;
  }

  function webmoneyDoubleSaveError($wmr){
    if( !is_null($this->curr_num) && $this->curr_num != $wmr ){
      return false;
    }
    return true;
  }

  function updateDataUserProfile($post){
    $dataWhereArr['user_id'] = $this->userId;

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'users');
  }
}