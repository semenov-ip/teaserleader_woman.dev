<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_new_password {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    if( $this->checkEmptyEmail() ) return "empty_email";

    if( !$this->checkNonExistentEmail() ) return "non_existent_email";

    return true;
  }

  function checkEmptyEmail(){
    if( empty($_POST['email']) ){ return true; }

    return false;
  }

  function checkNonExistentEmail(){
    $whereEmalData['email'] = $_POST['email'];

    return $this->ci->select_models->select_one_row_where_column($whereEmalData, 'users');
  }
}