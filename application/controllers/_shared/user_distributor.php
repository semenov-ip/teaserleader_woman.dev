<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_distributor extends CI_Controller{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->load->model('select_models');

    $this->checkEmptyUserSession();

    $dataUser = $this->checkUserHash();

    if( !$dataUser ) { return $this->registrationPag(); }

    $functionName =  $dataUser->who;

    $this->$functionName($dataUser);
  }

  function checkEmptyUserSession(){
    if( !extract_key_this_array($this->session->userdata('user'), 'hash') ){ return $this->registrationPag(); }

    if( !extract_key_this_array($this->session->userdata('user'), 'user_id') ){ return $this->registrationPag(); }
  }

  function registrationPag(){
    redirect( "/_shared/log_out/", 'location');
  }

  function checkUserHash(){
    $dataWhereArr['hash'] = extract_key_this_array($this->session->userdata('user'), 'hash');

    return $this->checkCurrentHashWithDb($this->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'who, admin, hash', 'users'));
  }

  function checkCurrentHashWithDb($dataUser){
    if( $dataUser->hash === extract_key_this_array($this->session->userdata('user'), 'hash') ){
      return $dataUser;
    }

    return $this->registrationPag();
  }

  function partner(){
    // для партнера
  }

  function webmaster($dataUser){
    redirect( "/".$dataUser->who."/sites/", 'location');
  }

  function teaser($dataUser){
    redirect( "/".$dataUser->who."/campaigns/", 'location');
  }

  function moderator($dataUser){
    //if($dataUser->moderator){ /* определенный редирект в модератора */ }
  }

  function admin($dataUser){
    /* определенный редирект в администратора */
    if($dataUser->admin){ return registrationPag(); }
    redirect("/".$dataUser->who."/sites/", 'location');
  }
}