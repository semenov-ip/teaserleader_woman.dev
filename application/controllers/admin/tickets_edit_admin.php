<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets_edit_admin extends CI_Controller {

  private $who, $ticketId, $userAuthorEmail;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($ticketId){
    $this->load->helper('date2str');
    $this->load->helper('tickets_function');
    $this->load->helper('extract_key_this_object');
    $this->load->helper('status/update_status');
    $this->load->library('send_mail');
    $this->load->library('/_shared/validation_data_ticket_edit');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->model('update_models');

    $this->getTickedId($ticketId); $this->getPostUserAuthorEmail();

    $data = template_builder('admin','ticked_edit_admin_tpl',$this->who, 'tickets_admin');

    $data['error'] = extract_key_this_array($this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery());

    $data['ticketDataObj'] = $this->getTicketData();

    $data['close'] = !in_array($data['ticketDataObj'][0]->status, array('3', '4'));

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTickedId($ticketId){
    $this->ticketId = $ticketId;
  }

  function getPostUserAuthorEmail(){
    if( isset($_POST['user_author_email']) ){

      $this->userAuthorEmail = $_POST['user_author_email'];

      unset($_POST['user_author_email']);
    }
  }

  function getTicketData(){
    $dataWhereArr['ticket_id'] = $this->ticketId;
    $dataWhereArr['upid'] = $this->ticketId;

    return $this->checkDataImplementCurrentSite($this->select_models->select_all_row_or_where_column_selectcolumn($dataWhereArr, 'ticket_id, user_id, author_name, title, text, dataadd, status', 'tickets'));
  }

  function checkDataImplementCurrentSite($ticketDataObj){
    if(is_array($ticketDataObj)){

      foreach ($ticketDataObj as $key => $currentTicketDataObj) {

        $currentTicketDataObj->dataadd = date2str($currentTicketDataObj->dataadd);

        $ticketDataObj[$key]->user_call = ($currentTicketDataObj->author_name !== "Администратор") ? linkUserCallOn($currentTicketDataObj->user_id, $currentTicketDataObj->author_name) : linkUserCallOff($currentTicketDataObj->author_name);

        $ticketDataObj[$key]->user_roles = ($currentTicketDataObj->author_name !== "Администратор") ? byUserRoles() : byAdminRoles();

      }

      $ticketDataObj[0]->user_author_email = $this->getUserAuthorEmail($ticketDataObj[0]->user_id);

      return $ticketDataObj; 
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function getUserAuthorEmail($userId){
    return extract_key_this_object($this->select_models->select_one_row_where_column_selectcolumn(array('user_id' => $userId),'email', 'users'), 'email');
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

        update_status(array('admin_status' => 1), array( 'ticket_id' => $this->ticketId ), 'tickets');

        update_status(array('status' => 1), array( 'ticket_id' => $this->ticketId ), 'tickets');

        $this->send_mail->sendMailMessage($this->userAuthorEmail, $_POST['title'], $_POST['text']);

        redirect( "/admin/tickets_edit_admin/index/$this->ticketId/", 'location');
      }

    }

    return false;
  }

  function updateTicketData($addDataArr){
    $addDataArr['upid'] = $this->ticketId;
    $addDataArr['user_id'] = $this->getUserIdAuthor($this->ticketId);
    $addDataArr['dataadd'] = $this->config->item('datetime');

    return $this->insert_models->insert_data_return_id($addDataArr, 'tickets');
  }

  function getUserIdAuthor($ticketId){
    $dataWhereArr['ticket_id'] = $ticketId;

    $userIdTicketsArr = $this->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'user_id', 'tickets');

    return $userIdTicketsArr->user_id;
  }
}