<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Check_users_access {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function checkUsers(){
    $this->ci->load->helper('extract_key_this_array');
    $this->ci->load->model('select_models');
    $this->ci->load->model('insert_models');

    $this->checkEmptyUserSession();

    $permissionUserWho = $this->executeActionOverUserReturnWho($this->checkHashUserInDb());

    $permissionDirArr = $this->$permissionUserWho();

    $currentDir = current_dir_extract();

    if( array_search($currentDir, $permissionDirArr) === false ){
      return $this->sendUserDistributor();
    }

    return $permissionUserWho;
  }

  function checkEmptyUserSession(){
    if( !extract_key_this_array($this->ci->session->userdata('user'), 'hash') ){ return $this->sendUserDistributor(); }

    if( !extract_key_this_array($this->ci->session->userdata('user'), 'user_id') ){ return $this->sendUserDistributor(); }
  }

  function checkHashUserInDb(){
    $dataWhereArr['hash'] = extract_key_this_array($this->ci->session->userdata('user'), 'hash');

    return $this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'who', 'users');
  }

  function executeActionOverUserReturnWho($dataUserWho){
    if( !is_object($dataUserWho) ){ return $this->sendUserDistributor(); }

    return $dataUserWho->who;
  }

  function sendUserDistributor(){
    redirect( "/_shared/user_distributor/", 'location');
  }

  function partner(){
    return array(
      'partner',
      'webmaster',
      '_shared',
      'balance'
    );
  }

  function webmaster(){
    $this->saveWebmasterIp();

    return array(
      'webmaster',
      'partner',
      '_shared',
      'balance'
    );
  }

  function teaser(){
    return array(
      'teaser',
      'partner',
      '_shared',
      'balance'
    );
  }

  function moderator(){
    return array(
      'webmaster',
      'partner',
      'moderator',
      'teaser',
      '_shared',
      'balance'
    );
  }

  function admin(){
    return array(
      'webmaster',
      'partner',
      'moderator',
      'teaser',
      'admin',
      '_shared',
      'balance'
    );
  }

  function saveWebmasterIp(){
    $dataWhereArr['userip'] = sprintf('%u', ip2long(getenv("REMOTE_ADDR")));
    $dataWhereArr['user_id'] = extract_key_this_array($this->ci->session->userdata('user'), 'user_id');

    if(!$this->ci->select_models->selectcolumn_limit_where_return_boolean($dataWhereArr, 'userip_id', 1, 'userip')){

      $this->ci->insert_models->insert_data_return_id($dataWhereArr, 'userip');

    }
  }
}