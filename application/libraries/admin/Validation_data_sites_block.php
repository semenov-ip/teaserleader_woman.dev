<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_sites_block {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    if( $this->emptyTextBlocking() ){ return "empty_text_blocking"; }

    return true;
  }

  function emptyTextBlocking(){
    if( empty($_POST['text']) ){ return true; }

    return false;
  }
}