<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Tickets_admin extends CI_Controller{

  private $who, $dataWhereArr;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_ticket_name');
    $this->load->helper('date2str');
    $this->load->helper('pagination_initialize');
    $this->load->helper('select_define_builder');
    $this->load->library('admin/data_builder_ticket_html_elements');
    $this->load->model('select_models');
    $this->load->model('pagination/ticket_pagination');

    $data = template_builder('admin','tickets_admin_tpl', $this->who);

    $this->getDataWhereArr();

    $data['ticketDataObj'] = $this->getTicketData();

    $data = $this->data_builder_ticket_html_elements->data($data);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTicketData(){
    $perPagePagination = pagination_initialize('/index.php/admin/tickets_admin/index/', $this->totalRows(), 20);

    return $this->setDataProcessing($this->ticket_pagination->select_all_row_where_column_selectcolumn_orderby_pagination($this->dataWhereArr,'dataadd', 'desc', 'ticket_id, user_id, title, text, dataadd, status', $perPagePagination, intval($this->uri->segment(4)), 'tickets'));
  }

  function totalRows(){
    return $this->ticket_pagination->select_all_row_where_column_selectcolumn_orderby_pagination_count($this->dataWhereArr, 'dataadd', 'tickets');
  }

  function getDataWhereArr(){
    $this->dataWhereArr = ( isset($_POST['status']) && $_POST['status'] !== '-1') ? array( 'status' => $_POST['status'] ) : array();

    $this->dataWhereArr['upid'] = 0;
  }

  function setDataProcessing($ticketDataObj){
    if(is_array($ticketDataObj)){

      foreach ($ticketDataObj as $key => $currentTicketDataObj) {

        $currentTicketDataObj->status = incite_status_ticket_name($currentTicketDataObj->status);

        $currentTicketDataObj->dataadd = date2str($currentTicketDataObj->dataadd);

        $currentTicketDataObj->email = $this->getUserAuthorEmail($currentTicketDataObj->user_id);
      }

      return $ticketDataObj;

    }

    return false;
  }

  function getUserAuthorEmail($userId){
    return extract_key_this_object($this->select_models->select_one_row_where_column_selectcolumn(array('user_id' => $userId),'email', 'users'), 'email');
  }
}