<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Users_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_user_name');
    $this->load->helper('date2str');
    $this->load->model('select_models');

    $data = template_builder('admin', 'users_admin_tpl', $this->who);

    $data['userDataObj'] = $this->getUserAllData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserAllData(){
    return $this->setDataProcessing($this->select_models->select_all_row_selectcilumn_orderby('user_id, email, name, count_money, dataadd, status', 'user_id', 'desc', 'users'));
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