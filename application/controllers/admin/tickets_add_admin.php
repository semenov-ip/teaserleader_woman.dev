<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Tickets_add_admin extends CI_Controller{

  private $who, $userId;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($userId){
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('send_mail');
    $this->load->library('/_shared/validation_data_ticket');

    $this->getUserId($userId);

    $data = template_builder('admin','ticked_add_admin_tpl', $this->who, 'tickets_admin');

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataTicketAdd() );

    $data['ticketDataObj'] = empty($_POST) ? (object)$this->getTicketKey() : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserId($userId){
    $this->userId = $userId;
  }

  function getTicketKey(){
    return $this->select_models->show_columns('tickets');
  }

  function getPostDataTicketAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_ticket->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->send_mail->sendMailMessage($this->userAuthorEmail(), $_POST['title'], $_POST['text']);

      $this->saveTicketData($_POST);
    }

    return false;
  }

  function userAuthorEmail(){
    return extract_key_this_object($this->select_models->select_one_row_where_column_selectcolumn(array('user_id' => $this->userId),'email', 'users'), 'email');
  }

  function saveTicketData($addDataArr){
    $addDataArr['dataadd'] = $this->config->item('datetime');
    $addDataArr['user_id'] = $this->userId;
    $addDataArr['status'] = 1;

    $ticketId = $this->insert_models->insert_data_return_id($addDataArr, 'tickets');

    if($ticketId){
      redirect( "/admin/tickets_admin/", 'location');
    }
  }
}