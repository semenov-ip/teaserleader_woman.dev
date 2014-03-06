<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Authentication extends CI_Controller{

  protected $userIdHash;

  function __construct(){
    
    parent::__construct();

    $this->userIdHash = 0;
  }
  
  function index(){
    $this->load->helper('execute_trim_empty_form');
    $this->load->helper('header_src_css_js');
    $this->load->helper('extract_key_this_array');
    $this->load->model('select_models');
    $this->load->model('update_models');

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataAuthentication() );

    $data['header'] = header_src_css_js('welcome', false);

    $this->load->view( '/welcome/authentication_tpl', $data );
  }

  function getPostDataAuthentication(){
    if(!empty($_POST)){

      if( !execute_trim_empty_form($_POST) ) return "empty_data";

      if( !is_object($this->check_user_mail_password($_POST)) ) return "email_password_incorrect";

      $this->updateLastDataAuthentication();

      return $this->successfullyAuthentication();

    }

    return false;
  }

  function check_user_mail_password($post){
    $post['password'] = md5($post['email'].$post['password']);

    $this->userIdHash = $this->select_models->select_one_row_where_column_selectcolumn($post, 'user_id, hash', 'users');

    return $this->userIdHash;
  }

  function updateLastDataAuthentication(){
    $dataUpdateArr['last_data_auth'] = $this->config->item('date');

    $dataWhereArr['user_id'] = $this->userIdHash->user_id;

    $this->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'users');
  }

  function successfullyAuthentication(){
    $this->session->set_userdata( array('user' => array( 'hash' => $this->userIdHash->hash, 'user_id' => $this->userIdHash->user_id )) );

    redirect( "/_shared/user_distributor/", 'location'); 
  }
}