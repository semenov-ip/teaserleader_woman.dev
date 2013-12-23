<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_block {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    $_POST = trim_stripslashes($_POST);

    if( $this->checkEmptyName() ){ return "empty_name_block"; }

    if( $this->checkEmptyBlockSize() ){ return "empty_block_size"; }

    if( $this->checkEmptyPosition() ){ return "empty_position"; }

    if( $this->checkEmptyAlign() ){ return "empty_align"; }

    return true;
  }

  function checkEmptyName(){
    if( empty($_POST['name']) ){ return true; }

    return false;
  }

  function checkEmptyBlockSize(){
    if( empty($_POST['block_size_num']) ){ return true; }

    return false;
  }
  
  function checkEmptyPosition(){
    if($_POST['position'] != 'left' && $_POST['position'] != 'right' && $_POST['position'] != 'top'){ return true; }

    return false;
  }

  function checkEmptyAlign(){
    if($_POST['align'] != 'center' && $_POST['align'] != 'left' && $_POST['align'] != 'right'){ return true; }

    return false;
  }

}