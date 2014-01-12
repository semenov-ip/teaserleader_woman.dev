<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets_edit extends CI_Controller {

  private $who, $ticketId;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($ticketId){
    $this->load->helper('date2str');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('/_shared/validation_data_ticket_edit');

    $this->getTickedId($ticketId);

    $data = template_builder('admin','admin_ticked_edit_tpl',$this->who);

    $data['error'] = extract_key_this_array($this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery());

    $data['ticketDataObj'] = $this->getTicketData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTickedId($ticketId){
    $this->ticketId = $ticketId;
  }

  function getTicketData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $dataWhereArr['ticket_id'] = $this->ticketId;

    return $this->checkDataImplementCurrentSite($this->select_models->select_all_row_or_where_column_selectcolumn($dataWhereArr, 'ticket_id, author_name, title, text, dataadd, status', 'tickets'));
  }

  function checkDataImplementCurrentSite($ticketDataObj){
    if(is_array($ticketDataObj)){ 

      foreach ($ticketDataObj as $key => $currentTicketDataObj) {

        $currentTicketDataObj->dataadd = date2str($currentTicketDataObj->dataadd);

      }

      return $ticketDataObj; 
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataTicketAdd();
  }

  function getPostDataTicketAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_ticket_edit->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->updateTicketData($_POST)){

        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/_shared/tickets_edit/index/$this->ticketId/", 'location');
      }

    }

    return false;
  }

  function updateTicketData($addDataArr){
    $addDataArr['upid'] = $this->ticketId;
    $addDataArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $addDataArr['dataadd'] = $this->config->item('datetime');

    return $this->insert_models->insert_data_return_id($addDataArr, 'tickets');
  }

}