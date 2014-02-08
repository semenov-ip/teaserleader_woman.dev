<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Users_return_admin extends CI_Controller {

  private $who, $userId;

  function __construct(){

    parent::__construct();
  }

  function index(){
    $this->load->model('select_models');

    $this->getUserId();

    return $this->setUserSession($this->getUserAllData());
  }

  function getUserId(){
    $this->userId = extract_key_this_array($this->session->userdata('user'), 'admin_id');
  }

  function getUserAllData(){
    return $this->setDataProcessing($this->select_models->select_one_row_where_column_selectcolumn( array('user_id' => $this->userId), 'user_id, hash', 'users'));
  }

  function setDataProcessing($siteDataObj){
    if(is_object($siteDataObj)){ return $siteDataObj; }

    redirect( "/_shared/user_distributor/", 'location');
  }

  function setUserSession($siteDataObj){
    $this->session->set_userdata(array('user' => array('hash' => $siteDataObj->hash, 'user_id' => $siteDataObj->user_id)));

    return redirect( "/_shared/user_distributor/", 'location'); 
  }
}