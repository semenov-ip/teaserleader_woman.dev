<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Users_redirected_admin extends CI_Controller {

  private $who, $userId;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($userId){
    $this->load->model('select_models');

    $this->getUserId($userId);

    return $this->setUserSession($this->getUserAllData());
  }

  function getUserId($userId){
    $this->userId = $userId;
  }

  function getUserAllData(){
    return $this->setDataProcessing($this->select_models->select_one_row_where_column_selectcolumn( array('user_id' => $this->userId), 'user_id, hash', 'users'));
  }

  function setDataProcessing($siteDataObj){
    if(is_object($siteDataObj)){ return $siteDataObj; }

    redirect( "/_shared/user_distributor/", 'location');
  }

  function setUserSession($siteDataObj){
    $this->session->set_userdata(array(
      'user' => 
      array( 
        'who' => 'admin',
        'admin_id' => extract_key_this_array($this->session->userdata('user'), 'user_id'),
        'hash' => $siteDataObj->hash, 
        'user_id' => $siteDataObj->user_id)
      )
    );

    return redirect( "/_shared/user_distributor/", 'location'); 
  }
}