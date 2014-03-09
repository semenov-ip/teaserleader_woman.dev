<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Tickets extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_ticket_name');
    $this->load->helper('date2str');
    $this->load->model('select_models');

    $data = template_builder('admin','admin_tickets_tpl', $this->who);

    $data['ticketDataObj'] = $this->getTicketData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTicketData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $dataWhereArr['upid'] = 0;

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_orderby($dataWhereArr, 'dataadd', 'desc', 'ticket_id, title, text, dataadd, status', 'tickets'));
  }

  function setDataProcessing($ticketDataObj){
    if(is_array($ticketDataObj)){

      foreach ($ticketDataObj as $key => $currentTicketDataObj) {

        $currentTicketDataObj->status = incite_status_ticket_name($currentTicketDataObj->status);

        $currentTicketDataObj->dataadd = date2str($currentTicketDataObj->dataadd);

      }

      return $ticketDataObj;

    }

    return false;
  }
}