<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_sending {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    if( $this->emptyTitleData() ){ return "emprt_title_ticket"; }

    if( $this->emptyTextData() ) { return "emprt_text_ticket"; }

    return true;
  }

  function emptyTitleData(){
    if( empty($_POST['title']) ){ return true; }

    return false;
  }

  function emptyTextData(){
    if( empty($_POST['text']) ){ return true; }

    return false;
  }
}