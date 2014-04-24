<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Users_admin extends CI_Controller{

  private $who, $dataWhereArr;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_user_name');
    $this->load->helper('date2str');
    $this->load->helper('pagination_initialize');
    $this->load->library('admin/search_id_mail');
    $this->load->model('pagination/user_pagination');

    $data = template_builder('admin', 'users_admin_tpl', $this->who);

    $this->getDataWhereArr();

    $data['userDataObj'] = $this->getUserAllData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserAllData(){
    $perPagePagination = pagination_initialize('/index.php/admin/users_admin/index/', $this->totalRows());

    return $this->setDataProcessing($this->user_pagination->select_all_row_whereforeach_selectcilumn_orderby_pagination($this->dataWhereArr, 'user_id, email, name, count_money, dataadd, status', 'user_id', 'desc', $perPagePagination, intval($this->uri->segment(4)), 'users'));
  }

  function totalRows(){
    return $this->user_pagination->select_all_row_whereforeach_selectcilumn_orderby_pagination_count($this->dataWhereArr, 'user_id', 'users');
  }

  function getDataWhereArr(){
    $this->dataWhereArr = ( !empty($_POST['search']) ) ? $this->search_id_mail->getSearchData($_POST['search']) : array();
  }

  function setDataProcessing($userDataObj){
    if(is_array($userDataObj)){ 

      foreach ($userDataObj as $key => $currentUserDataObj) {

        $currentUserDataObj->dataadd = date2str($currentUserDataObj->dataadd);

        $currentUserDataObj->status = incite_status_user_name($currentUserDataObj->status);

      }

      return $userDataObj;
    }

    return false;
  }
}