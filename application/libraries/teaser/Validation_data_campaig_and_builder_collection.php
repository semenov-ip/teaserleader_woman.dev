<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_campaig_and_builder_collection {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){
    $_POST = trim_stripslashes($_POST, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

    $_POST = setup_array_noisset_data($_POST, array('ban_country', 'ban_region', 'ban_hour', 'ban_week_day'));

    if( $this->nameCleanCheckEmptyInputData() ) return "empty_name";

    if( $this->issetSubidNotSubid() ) return "empty_subid";

    return true;
  }

  function nameCleanCheckEmptyInputData(){
    if( empty($_POST['name']) ) { return true; }

    return false;
  }

  function issetSubidNotSubid(){
    if( $_POST['labels'] == "_subid" && empty($_POST['subid']) ){
      return true;
    }

    return false;
  }
}