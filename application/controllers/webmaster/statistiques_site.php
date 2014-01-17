<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_site extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('webmaster_statistiq_default_data');
    $this->load->helper('select_define_builder');
    $this->load->library('/statistiques/statistiques_frompost_count_data');
    $this->load->library('/webmaster/data_builder_statistiq_site_html_elements');
    $this->load->model('/statistiques/statistiques_query');
    $this->load->model('select_models');

    $data = template_builder('admin','statistiques_site_tpl',$this->who);

    $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    $data['siteDataAllArrObj'] = $this->getSiteData();

    $data = $this->data_builder_statistiq_site_html_elements->data($data);

    $data['urlError'] = $this->getBooleanPostUrl();

    $data['siteStatistiqDataArr'] = $this->getSiteStatistiqDataArr();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->checkData($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'site_id, url', 'sites'));
  }

  function checkData($siteDataAllArrObj){
    if(is_array($siteDataAllArrObj)){ return $siteDataAllArrObj; }

    return false;
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data('url');
  }

  function getBooleanPostUrl(){
    if( empty($_POST) ){ return true; }
    if( $_POST['url'] == -1 ){ return true; }

    return false;
  }

  function getSiteStatistiqDataArr(){

    $statistiqConfig = array(
      'select_column' => 'site_id, url',
      'table_name' => 'sites',
      'column_id' => 'site_id',
    );

    return $this->statistiques_frompost_count_data->getStatistiqCount($statistiqConfig);

  }
}