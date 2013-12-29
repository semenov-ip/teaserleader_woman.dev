<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_settings {
  public $ci, $curr_num;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($curr_num){

    $this->getCurrNum($curr_num);

    if( !execute_trim_empty_form( $_POST, array('icq', 'skype') ) ) return "empty_data";

    if( !$this->webmoneyDoubleSaveError($_POST['curr_num']) ) return "webmoney_double_save";

    return true;
  }

  function getCurrNum($curr_num){
    $this->curr_num = $curr_num;
  }

  function webmoneyDoubleSaveError($wmr){
    
    if( $this->curr_num != $wmr ){
      
      $_POST['curr_num'] = $this->curr_num;
      
      return false;
    }
    
    return true;
  }

}