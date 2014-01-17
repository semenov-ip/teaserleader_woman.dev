<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_site extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('get_define_day');
    $this->load->model('/statistiques/statistiques_query');
    $this->load->model('select_models');
    $this->load->library('/statistiques/statistiques_count_data');

    $data = template_builder('admin','statistiques_site_tpl',$this->who);

    $data['siteStatistiqDataArr'] = $this->getSiteStatistiqDataArr();

    $data['defineDay'] = get_define_day();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteStatistiqDataArr(){

    $statistiqConfig = array(
      'select_column' => 'site_id, url',
      'table_name' => 'sites',
      'column_id' => 'site_id',
    );

    return $this->statistiques_count_data->getStatistiqCount($statistiqConfig);

  }
}