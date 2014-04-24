<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_ticket_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){
    $status = isset($_POST['status']) ? $_POST['status'] : '-1';

    $data['selectStatus'] = select_define_builder( array($status), status_ticket_name_key_value(), true );

    return $data;
  }
}