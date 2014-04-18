<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_geo extends CI_Controller {

  private $who;

  function __construct(){

    parent::__construct();

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

    $data = template_builder('admin','statistiques_geo_tpl',$this->who);

    $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    $data = $this->data_builder_statistiq_geo_html_elements->data($data);

    $data['keyformname'] = 'country';

    $booleanPostUrl = $this->getBooleanPostUrl();

    $data['urlError'] = $booleanPostUrl;

    $data['geoStatistiqDataArr'] = $this->getGeoStatistiqDataArr( $booleanPostUrl );

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data('country');
  }

  function getBooleanPostUrl(){
    if( empty($_POST) ){ return true; }
    if( $_POST['country'] == -1 ){ return true; }

    $_POST['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return false;
  }

  function getGeoStatistiqDataArr($booleanPostUrl){
    if( $booleanPostUrl ){ return false; }

    $statistiqConfig = array(
      'select_column' => $_POST['country'].'_view, '.$_POST['country'].'_click, money, dataadd',
      'table_name' => 'geo',
      'view_column' => $_POST['country'].'_view',
      'click_column' => $_POST['country'].'_click'
    );

    return $this->statistiques_frompost_countdata_country->getStatistiqCount($statistiqConfig, extract_select_key_this_array($_POST, array('country', 'date_start', 'date_end')));

  }
}