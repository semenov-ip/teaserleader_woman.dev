<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('template_builder');

    $data = template_builder('admin','sites_tpl',$this->who,true);

    $data['siteDataObj'] = $this->getSiteData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'site_id, url', 'sites');
  }
}