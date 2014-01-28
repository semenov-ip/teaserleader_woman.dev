<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_registration {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    if( !execute_trim_empty_form($_POST) ) return "empty_data";

    if( !$this->passwordConfirm($_POST) ) return "password_confirm";

    if( $this->emailConfirmDb($_POST['email']) ) return "email_confirm";

    if( !$this->webmoneyInputError($_POST['purse']) ) return "webmoney_input_error";

    unset($_POST['password_confirm']);

    return true;
  }

  function passwordConfirm($post){
    if($post['password'] === $post['password_confirm']){

      return true;

    }
    return false;
  }

  function emailConfirmDb($emailUser){
    $whereEmalData['email'] = $emailUser;

    return $this->ci->select_models->select_one_row_where_column($whereEmalData, 'users');
  }

  function webmoneyInputError($wmr){
    if(substr($wmr, 0, 1) != 'R' || strlen($wmr) != 13){
      return false;
    }
    return true;
  }

}