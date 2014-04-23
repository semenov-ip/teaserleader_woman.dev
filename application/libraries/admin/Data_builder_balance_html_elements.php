<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_balance_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){
  	$status = isset($_POST['status']) ? $_POST['status'] : '0';

    $data['selectStatus'] = select_define_builder( array($status), status_balance_name_key_value(), true );

    return $data;
  }
}