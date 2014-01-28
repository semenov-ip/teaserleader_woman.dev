<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_settings {
  public $ci, $purse;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($purse){

    $this->getPurse($purse);

    if( !execute_trim_empty_form( $_POST, array('icq', 'skype') ) ) return "empty_data";

    if( !$this->webmoneyDoubleSaveError($_POST['purse']) ) return "webmoney_double_save";

    return true;
  }

  function getPurse($purse){
    $this->purse = $purse;
  }

  function webmoneyDoubleSaveError($wmr){
    
    if( $this->purse != $wmr ){
      
      $_POST['purse'] = $this->purse;
      
      return false;
    }
    
    return true;
  }

}