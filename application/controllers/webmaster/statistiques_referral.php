<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_referral extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    // $this->load->helper('webmaster_statistiq_default_data');
    // $this->load->helper('extract_select_key_this_array');
    // $this->load->helper('timestamp_of_date_formt');
    // $this->load->library('/statistiques/statistiques_frompost_countdate_data');
    // $this->load->library('/webmaster/data_builder_statistiq_site_html_elements');
    // $this->load->model('/statistiques/statistiques_query');
    // $this->load->model('select_models');

    $data = template_builder('admin','statistiques_referral_tpl',$this->who);

    // $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    // $data['dataAllArrObjThere'] = $this->getDataAllArrObjThere();

    // $data['referralStatistiqDataArr'] = $this->getReferralStatistiqDataArr($data['statistiqData']);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getDataAllArrObjThere(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->checkData($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'site_id, url', 'sites'));
  }

  function checkData($siteDataAllArrObj){
    if(is_array($siteDataAllArrObj)){ return $siteDataAllArrObj; }

    return false;
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data();
  }

  function getReferralStatistiqDataArr($statistiqData){

    $statistiqConfig = array(
      'select_column' => 'money_referral, dataadd',
      'table_name' => 'sites',
      'column_id' => 'site_id',
    );

    return $this->statistiques_frompost_countdate_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array( $statistiqData, array('date_start', 'date_end')) );

  }
}