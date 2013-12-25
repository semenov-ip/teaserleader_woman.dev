<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Settings extends CI_Controller{

  private $who, $top10Login, $curr_num;

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

    $data = template_builder('admin','admin_settings_tpl', $this->who, true);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['userDataObj'] = empty($_POST) ? $userDataObj : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserData(){
    $dataWhereArr['hash'] = extract_key_this_array($this->session->userdata('user'), 'hash');

    return $this->cleanAddDataInput($this->select_models->select_one_row_where_column($dataWhereArr, 'users'));
  }

  function cleanAddDataInput($dataUserObj){
    $this->curr_num = $dataUserObj->curr_num;

    $this->top10Login = $dataUserObj->top10_login;

    $dataUserObj->curr_num = is_null($dataUserObj->curr_num) ? "R" : $dataUserObj->curr_num;

    return $dataUserObj;
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataSettingsUpdate();
  }

  function getPostDataSettingsUpdate(){
    if(!empty($_POST)){

      $_POST = $this->top10LoginPartyNoDelenKey($_POST);

      if( !execute_trim_empty_form( $_POST, array('notshow_top10_login') ) ) return "empty_data";

      if( !$this->webmoneyDoubleSaveError($_POST['curr_num']) ) return "webmoney_double_save";

      if( !$this->webmoneyInputError($_POST['curr_num']) ) return "webmoney_input_error";

      if($this->updateDataUserProfile($_POST)){

        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/webmaster/settings/", 'location');
      }
    }

    return false;
  }

  function top10LoginPartyNoDelenKey($post){

    if( !isset($_POST['notshow_top10_login']) ){

      $post['notshow_top10_login'] = 0;

      $post['top10_login'] = empty($post['top10_login']) ? $post['name'] : $post['top10_login'];
      
      return $post;
    }

    $post['top10_login'] = empty($this->top10Login) ? $post['name'] : $this->top10Login;

    return $post;
  }

  function webmoneyDoubleSaveError($wmr){
    if( !is_null($this->curr_num) && $this->curr_num != $wmr ){
      $_POST['curr_num'] = $this->curr_num;
      return false;
    }
    return true;
  }

  function webmoneyInputError($wmr){
    if(substr($wmr, 0, 1) != 'R' || strlen($wmr) != 13){
      return false;
    }
    return true;
  }

  function updateDataUserProfile($post){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'users');
  }
}