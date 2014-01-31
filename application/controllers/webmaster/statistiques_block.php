<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_block extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('webmaster_statistiq_default_data');
    $this->load->helper('select_define_builder');
    $this->load->helper('extract_select_key_this_array');
    $this->load->helper('timestamp_of_date_formt');
    $this->load->library('/statistiques/statistiques_frompost_count_data');
    $this->load->library('/webmaster/data_builder_statistiq_block_html_elements');
    $this->load->model('/statistiques/statistiques_query');
    $this->load->model('select_models');

    $data = template_builder('admin','statistiques_block_tpl',$this->who);

    $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    $data['blockDataAllArrObj'] = $this->getBlockData();

    $data = $this->data_builder_statistiq_block_html_elements->data($data);

    $data['keyformname'] = 'name';

    $data['urlError'] = $this->getBooleanPostUrl();

    $data['blockStatistiqDataArr'] = $this->getBlockStatistiqDataArr();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBlockData(){
    $dataWhereArr = $this->who != "admin" ? array('user_id' => extract_key_this_array($this->session->userdata('user'), 'user_id')) : array();

    return $this->checkData($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'block_id, name', 'blocks'));
  }

  function checkData($blockDataAllArrObj){
    if(is_array($blockDataAllArrObj)){ return $blockDataAllArrObj; }

    return false;
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data('name');
  }

  function getBooleanPostUrl(){
    if( empty($_POST) ){ return true; }
    if( $_POST['name'] == -1 ){ return true; }

    return false;
  }

  function getBlockStatistiqDataArr(){
    if( $this->getBooleanPostUrl() ){ return false; }

    $statistiqConfig = array(
      'select_column' => 'block_id, view, click, money, dataadd',
      'table_name' => 'blocks',
      'column_id' => 'block_id',
      'keyformname' => 'name'
    );

    return $this->statistiques_frompost_count_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array($_POST, array('block_id', 'date_start', 'date_end')));

  }
}