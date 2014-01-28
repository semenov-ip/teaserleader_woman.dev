<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Users_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->model('select_models');

    $data = template_builder('admin','users_admin_tpl',$this->who);

    $data['userDataObj'] = $this->getUserAllData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getUserAllData(){
    return $this->setDataProcessing($this->select_models->select_all_row_selectcilumn_orderby('user_id, email, name, skype, count_money, dataadd', 'user_id', 'asc', 'users'));
  }

  function setDataProcessing($siteDataObj){
    if(is_array($siteDataObj)){ return $siteDataObj; }

    return false;
  }
}