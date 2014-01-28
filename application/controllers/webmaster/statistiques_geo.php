<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_geo extends CI_Controller {

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
    $this->load->helper('extract_select_key_this_moneycountry');
    $this->load->library('/statistiques/statistiques_frompost_countdata_country');
    $this->load->library('/webmaster/data_builder_statistiq_geo_html_elements');
    $this->load->model('/statistiques/statistiques_query');
    // $this->load->model('select_models');

    $data = template_builder('admin','statistiques_geo_tpl',$this->who);

    $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    $data['siteDataAllArrObj'] = $this->getSiteData();

    $data = $this->data_builder_statistiq_geo_html_elements->data($data);

    $data['keyformname'] = 'country';

    $data['urlError'] = $this->getBooleanPostUrl();

    $data['geoStatistiqDataArr'] = $this->getGeoStatistiqDataArr();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data('country');
  }


  function getSiteData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->checkData($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'site_id, url', 'sites'));
  }

  function checkData($siteDataAllArrObj){
    if(is_array($siteDataAllArrObj)){ return $siteDataAllArrObj; }

    return false;
  }

  function getBooleanPostUrl(){
    if( empty($_POST) ){ return true; }
    if( $_POST['country'] == -1 ){ return true; }

    return false;
  }

  function getGeoStatistiqDataArr(){
    if( $this->getBooleanPostUrl() ){ return false; }

    $money_column = extract_select_key_this_moneycountry($_POST['country']);

    $statistiqConfig = array(
      'select_column' => $_POST['country'].'_view, '.$_POST['country'].'_click, '.$money_column.' , dataadd',
      'table_name' => 'geo',
      'view_column' => $_POST['country'].'_view',
      'click_column' => $_POST['country'].'_click',
      'money_column' => $money_column
    );

    return $this->statistiques_frompost_countdata_country->getStatistiqCount($statistiqConfig, extract_select_key_this_array($_POST, array('country', 'date_start', 'date_end')));

  }
}