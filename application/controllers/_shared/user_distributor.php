<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_distributor extends CI_Controller{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->load->model('select_models');

    $userDataSession = $this->session->userdata('user');

    $dataUser = $this->checkUserHash($userDataSession['hash']);

    if( !$dataUser ) { return $this->registrationPag(); }

    $functionName =  $dataUser->who;

    $this->$functionName($dataUser);
  }

  function checkUserHash($userHash){
    $whereHashData['hash'] = $userHash;

    return $this->select_models->select_one_row_where_column_selectcolumn($whereHashData, 'who, admin, moderator', 'users');
  }

  function registrationPag(){
    redirect( "/welcome/authentication/", 'location');
  }

  function webmaster($dataUser){
    redirect( "/".$dataUser->who."/sites/", 'location');
  }

  function partner(){
    // для партнера
  }

  function moderator($dataUser){
    //if($dataUser->moderator){ /* определенный редирект в модератора */ }
  }

  function admin($dataUser){
    /* определенный редирект в администратора */
    //if($dataUser->admin){  }
  }
}







