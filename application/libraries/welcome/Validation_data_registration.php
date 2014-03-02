<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_registration {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    if(!execute_trim_empty_form($_POST)) return "empty_data";

    if($this->passwordConfirm()) return "password_confirm";

    if($this->emailCheckValidationDb()) return "email_check_validation";

    if($this->emailConfirmDb()) return "email_confirm";

    if($this->webmoneyInputError()) return "webmoney_input_error";

    unset($_POST['password_confirm']);

    return true;
  }

  function passwordConfirm(){
    if($_POST['password'] === $_POST['password_confirm']){ return false; }

    return true;
  }

  function emailCheckValidationDb(){
    if(preg_match( "/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/", $_POST['email'] )){ return false; }

    return true;
  }

  function emailConfirmDb(){
    $whereEmalData['email'] = $_POST['email'];

    return $this->ci->select_models->select_one_row_where_column($whereEmalData, 'users');
  }

  function webmoneyInputError(){
    if(substr($_POST['purse'], 0, 1) != 'R' || strlen($_POST['purse']) != 13){ return true; }
    return false;
  }

}