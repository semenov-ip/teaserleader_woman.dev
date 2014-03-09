<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Section_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->model('select_models');

    $data = template_builder('admin','section_admin_tpl', $this->who);

    $data['sectionDataObj'] = $this->sectionDataObj();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function sectionDataObj(){
    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_orderby(array(), 'section_id', 'desc', 'section_name, price, price_sng', 'sections'));
  }

  function setDataProcessing($sectionDataObj){
    if(is_array($sectionDataObj)){

      return $sectionDataObj;

    }

    return false;
  }
}