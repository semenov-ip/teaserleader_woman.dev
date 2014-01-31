<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_teaser extends CI_Controller{

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
    $this->load->library('/teaser/data_builder_statistiq_teaser_html_elements');
    $this->load->library('/statistiques/statistiques_frompost_count_data');
    $this->load->model('/statistiques/statistiques_query');
    $this->load->model('select_models');

    $data = template_builder('admin','statistiques_teaser_tpl',$this->who);

    $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    $data['teaserDataAllArrObj'] = $this->getTeaserData();

    $data = $this->data_builder_statistiq_teaser_html_elements->data($data);

    $data['keyformname'] = 'url';

    $data['urlError'] = $this->getBooleanPostUrl();

    $data['teaserStatistiqDataArr'] = $this->getTeaserStatistiqDataArr();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data('url');
  }

  function getTeaserData(){
    $dataWhereArr = $this->who != "admin" ? array('user_id' => extract_key_this_array($this->session->userdata('user'), 'user_id')) : array();

    return $this->checkData($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'teaser_id, url', 'teasers'));
  }

  function checkData($siteDataAllArrObj){
    if(is_array($siteDataAllArrObj)){ return $siteDataAllArrObj; }

    return false;
  }


  function getBooleanPostUrl(){
    if( empty($_POST) ){ return true; }
    if( $_POST['url'] == -1 ){ return true; }

    return false;
  }

  function getTeaserStatistiqDataArr(){
    if( $this->getBooleanPostUrl() ){ return false; }

    $statistiqConfig = array(
      'select_column' => 'teaser_id, view, click, money, dataadd',
      'table_name' => 'teasers',
      'column_id' => 'teaser_id',
      'keyformname' => 'url'
    );

    return $this->statistiques_frompost_count_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array($_POST, array('teaser_id', 'date_start', 'date_end')));

  }
}