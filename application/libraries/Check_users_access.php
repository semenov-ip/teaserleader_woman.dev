<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Check_users_access {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function checkUsers(){
    $this->ci->load->helper('extract_key_this_array');
    $this->ci->load->model('select_models');

    $permissionUserWho = $this->executeActionOverUserReturnWho($this->checkHashUserInDb());

    $permissionDirArr = $this->$permissionUserWho();

    $currentDir = $this->currentDirExtract();

    if( array_search($currentDir, $permissionDirArr) === false ){
      return $this->sendUserDistributor();
    }

    return $permissionUserWho;
  }

  function checkHashUserInDb(){
    $dataWhereArr['hash'] = $this->getCurrentHashUser();

    return $this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'who', 'users');
  }

  function executeActionOverUserReturnWho($dataUserWho){
    if( !is_object($dataUserWho) ){ return $this->sendUserDistributor(); }

    return $dataUserWho->who;
  }

  function currentDirExtract(){
    $currentUrl = explode( "/", $_SERVER['REQUEST_URI'] );

    return $currentUrl[1];
  }

  function getCurrentHashUser(){
    return extract_key_this_array($this->ci->session->userdata('user'), 'hash');
  }

  function sendUserDistributor(){
    redirect( "/_shared/user_distributor/", 'location');
  }

  function webmaster(){
    return array(
      'webmaster',
      'partner'
    );
  }

  function partner(){
    return array(
      'partner',
      'webmaster'
    );
  }

  function moderator($dataUser){
    return array(
      'webmaster',
      'partner',
      'moderator',
      'tiser'
    );
  }

  function admin($dataUser){
    return array(
      'webmaster',
      'partner',
      'moderator',
      'tiser',
      'admin'
    );
  }
}