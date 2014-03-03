<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_new_password extends CI_Controller {

  protected $password;

  function __construct(){

    parent::__construct();

  }

  public function index() {
    $this->load->helper('header_src_css_js');
    $this->load->library('welcome/validation_data_new_password');
    $this->load->library('send_mail');
    $this->load->model('select_models');
    $this->load->model('update_models');

    $data['header'] = header_src_css_js('welcome', false);

    $data['userDataObj'] = empty($_POST) ? (object)$this->getUserData() : (object)$_POST;

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $this->load->view('/welcome/get_new_password_tpl.php', $data);
  }

  function getUserData(){
    return array('email' => '');
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataNewPassword();
  }

  function getPostDataNewPassword(){

    if(!empty($_POST)){

      $submitStatus = $this->validation_data_new_password->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->saveDataNewPassword($_POST);

      $this->sendDataNewPassword($_POST);
    }

    return false;
  }

  function saveDataNewPassword($post){
    $this->password = rand(1000000, 9999999);

    $dataUpdateArr['password'] = md5($post['email'].$this->password);

    $dataUpdateArr['dataadd'] = $this->config->item('datetime');

    $dataUpdateArr['hash'] = md5($post['email'].$dataUpdateArr['password'].$dataUpdateArr['dataadd']);

    $this->update_models->update_set_one_where_column($dataUpdateArr, array('email' => $post['email']), 'users');
  }

  function sendDataNewPassword($post){

    $this->send_mail->sendMailMessage($post['email'], 'Ваш новый пароль', 'Ваш новый пароль: '.$this->password, 'no-reply@'.$this->config->item('url'));

    $this->session->set_flashdata('successSaveUpdateData', 'success_sand');

    redirect( "/welcome/get_new_password/", 'location');
  }
}