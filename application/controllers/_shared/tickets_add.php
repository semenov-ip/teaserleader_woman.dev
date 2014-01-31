<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Tickets_add extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('/_shared/validation_data_ticket');

    $data = template_builder('admin','admin_tickets_add_tpl', $this->who, 'tickets');

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataTicketAdd() );

    $data['ticketDataObj'] = empty($_POST) ? (object)$this->getTicketKey() : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTicketKey(){
    return $this->select_models->show_columns('tickets');
  }

  function getPostDataTicketAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_ticket->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->saveTicketData($_POST);
    }

    return false;
  }

  function saveTicketData($addDataArr){
    $addDataArr['dataadd'] = $this->config->item('datetime');
    $addDataArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $ticketId = $this->insert_models->insert_data_return_id($addDataArr, 'tickets');

    if($ticketId){
      redirect( "/_shared/tickets/", 'location');
    }
  }
}