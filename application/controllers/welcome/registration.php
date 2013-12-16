<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Registration extends CI_Controller{

  private $referral;

  function __construct(){
    
    parent::__construct();

    $this->referral = 0;
  }

  function index($referral = NULL){
    $this->load->helper('execute_trim_empty_form');
    $this->load->helper('header_src_css_js');
    $this->load->helper('extract_key_this_array');
    $this->load->model('select_models');
    $this->load->model('insert_models');

    if(isset($referral)){ $this->referral = $referral; }

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataRegistration() );

    $data['header'] = header_src_css_js('welcome', false);
    
    $this->load->view( '/welcome/registration_tpl', $data );
  }

  function getPostDataRegistration(){
    
    if(!empty($_POST)){

      if( !execute_trim_empty_form($_POST) ) return "empty_data";
      
      if( !$this->passwordConfirm($_POST) ) return "password_confirm";

      if( $this->emailConfirmDb($_POST['email']) ) return "email_confirm";

      unset($_POST['password_confirm']);

      $this->saveDataCollectionUserRegistration($_POST);
    }

    return false;
  }

  function passwordConfirm($post){
    if($post['password'] === $post['password_confirm']){
      
      return true;
    
    }
    return false;
  }

  function emailConfirmDb($emailUser){
    $whereEmalData['email'] = $emailUser;

    return $this->select_models->select_one_row_where_column($whereEmalData, 'users');
  }

  function saveDataCollectionUserRegistration($post){
    $post['password'] = md5($post['email'].$post['password']);

    $post['who'] = "webmaster";

    $post['dataadd'] = $this->config->item('datetime');

    $post['hash'] = md5($post['email'].$post['password'].$post['dataadd']);

    $post['referral'] = $this->referral;

    $post['last_data_auth'] = $this->config->item('date');

    $idUser = $this->insert_models->insert_data_return_id($post, 'users');

    if($idUser){ 
      $this->session->set_userdata( array('user' => array('hash' => $post['hash'])) );

      redirect( "/_shared/user_distributor/", 'location'); 
    }
  }
}