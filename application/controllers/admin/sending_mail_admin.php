<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sending_mail_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('num2word_end');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('/admin/validation_data_sending');
    $this->load->library('send_mail');

    $data = template_builder('admin','sending_mail_admin_tpl', $this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['sendingDataObj'] = empty($_POST) ? (object)$this->getSendingKey() : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSendingKey(){
    return array ('title' => null, 'text' => null);
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataSendingAdd();
  }

  function getPostDataSendingAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_sending->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->sendingMailData($_POST);
    }

    return false;
  }

  function sendingMailData($sendDataArr){
    $userDataObj = $this->getUserDataObj();

    $from = 'no-reply@'.$this->config->item('url');

    foreach ($userDataObj as $key => $userEmail) {

      $this->send_mail->sendMailMessage($userEmail->email, $sendDataArr['title'], $sendDataArr['text'], $from );

    }

    $this->session->set_flashdata('successSaveUpdateData', 'success_save_send_mail');

    redirect( "/admin/sending_mail_admin/", 'location');
  }

  function getUserDataObj(){
    return $this->select_models->select_all_row_selectcilumn('email', 'users');
  }
}