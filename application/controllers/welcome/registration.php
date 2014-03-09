<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Registration extends CI_Controller{

  private $referral;

  function __construct(){
    parent::__construct();

    $this->referral = 0;

    check_users_authentication();
  }

  function index($referral = NULL){
    $this->load->helper('execute_trim_empty_form');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('welcome/validation_data_registration');

    if(isset($referral)){ $this->referral = $referral; }

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataRegistration() );

    $data['header'] = header_src_css_js('welcome', false);

    $data['userDataObj'] = empty($_POST) ? (object)$this->getUserData() : (object)$_POST;

    $this->load->view( '/welcome/registration_tpl', $data );
  }

  function getUserData(){
    return $this->select_models->show_columns_return_default('users');
  }

  function getPostDataRegistration(){

    if(!empty($_POST)){

      $submitStatus = $this->validation_data_registration->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->saveDataCollectionUserRegistration($_POST);
    }

    return false;
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
      $this->session->set_userdata( array('user' => array('hash' => $post['hash'], 'user_id' => $idUser)) );

      redirect( "/_shared/user_distributor/", 'location'); 
    }
  }
}