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
    $this->load->helper('tickets_function');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->model('update_models');
    $this->load->library('/_shared/validation_data_ticket_edit');

    $this->getTickedId($ticketId);

    $data = template_builder('admin','admin_ticked_edit_tpl',$this->who, 'tickets');

    $data['error'] = extract_key_this_array($this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery());

    $data['ticketDataObj'] = $this->getTicketData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTickedId($ticketId){
    $this->ticketId = $ticketId;
  }

  function getTicketData(){
    $dataANDWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $dataORWhereArr = array( 'ticket_id' => $this->ticketId, 'upid' => $this->ticketId );

    return $this->checkDataImplementCurrentSite($this->select_models->select_all_row_where_or_where_column_selectcolumn($dataORWhereArr, $dataANDWhereArr, 'ticket_id, author_name, title, text, dataadd, status', 'tickets'));
  }

  function checkDataImplementCurrentSite($ticketDataObj){
    if(is_array($ticketDataObj)){ 

      foreach ($ticketDataObj as $key => $currentTicketDataObj) {

        $currentTicketDataObj->dataadd = date2str($currentTicketDataObj->dataadd);

        $ticketDataObj[$key]->user_roles = ($currentTicketDataObj->author_name !== "Администратор") ? byUserRoles() : byAdminRoles();

      }

      if ($ticketDataObj[0]->status == 1){ $this->statusUpdate(2); }

      return $ticketDataObj; 
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function statusUpdate($statusNum){
    $dataUpdateArr['status'] = $statusNum;
    $dataWhereArr['ticket_id'] = $this->ticketId;

    $this->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'tickets');
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataTicketAdd();
  }

  function getPostDataTicketAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_ticket_edit->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->updateTicketData($_POST)){

        $this->statusAdminUpdate();

        $this->statusUpdate(0);

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

  function statusAdminUpdate(){
    $dataUpdateArr['admin_status'] = 0;
    $dataWhereArr['ticket_id'] = $this->ticketId;

    $this->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'tickets');
  }
}