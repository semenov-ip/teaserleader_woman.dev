<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_distributor extends CI_Controller{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->load->helper('extract_key_this_array');
    $this->load->model('select_models');

    $dataUser = $this->checkUserHash();

    if( !$dataUser ) { return $this->registrationPag(); }

    $functionName =  $dataUser->who;

    $this->$functionName($dataUser);
  }

  function checkUserHash(){
    $dataWhereArr['hash'] = extract_key_this_array($this->session->userdata('user'), 'hash');

    if(!$dataWhereArr['hash']){ return $this->registrationPag(); }

    return $this->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'who, admin, moderator', 'users');
  }

  function registrationPag(){
    redirect( "/welcome/authentication/", 'location');
  }

  function partner(){
    // для партнера
  }

  function webmaster($dataUser){
    redirect( "/".$dataUser->who."/sites/", 'location');
  }

  function tiser($dataUser){
    redirect( "/".$dataUser->who."/campaigns/", 'location');
  }

  function moderator($dataUser){
    //if($dataUser->moderator){ /* определенный редирект в модератора */ }
  }

  function admin($dataUser){
    /* определенный редирект в администратора */
    //if($dataUser->admin){  }
  }
}







