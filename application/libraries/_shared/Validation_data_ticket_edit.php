<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_ticket_edit {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    if( $this->emptyTextData() ) { return "emprt_text_ticket"; }

    return true;
  }

  function emptyTextData(){
    if( empty($_POST['text']) ){ return true; }

    return false;
  }
}