<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_referral extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('webmaster_statistiq_default_data');
    $this->load->helper('extract_select_key_this_array');
    $this->load->helper('timestamp_of_date_formt');
    $this->load->library('/statistiques/statistiques_frompost_count_data');
    $this->load->model('/statistiques/statistiques_query');

    $data = template_builder('admin','statistiques_referral_tpl',$this->who);

    $data['statistiqData'] = empty($_POST) ? $this->getFormDefaultData() : $_POST;

    $data['referralStatistiqDataArr'] = $this->getReferralStatistiqDataArr($data['statistiqData']);

    $data['referralUrl'] = 'http://'.$_SERVER['HTTP_HOST'].'/welcome/welcome/index/'.extract_key_this_array($this->session->userdata('user'), 'user_id').'/';

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getFormDefaultData(){
    return webmaster_statistiq_default_data();
  }

  function getReferralStatistiqDataArr($statistiqData){

    $statistiqConfig = array(
      'select_column' => 'money, dataadd, view, click',
      'table_name' => 'referral',
      'column_id' => 'user_id',
    );

    return $this->statistiques_frompost_count_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array($statistiqData, array('date_start', 'date_end')));
  }
}