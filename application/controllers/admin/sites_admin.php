<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->model('select_models');

    $data = template_builder('admin','sites_admin_tpl',$this->who);

    $data['siteDataObj'] = $this->getSiteAllData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteAllData(){
    $dataWhereArr = array();

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_join_orderby($dataWhereArr, 'ls.status', 'asc', 'users lu', 'ls.user_id = lu.user_id', 'ls.site_id, ls.user_id, ls.status, ls.url, ls.stat_login, lu.email', 'sites ls'));
  }

  function setDataProcessing($siteDataObj){
    if(is_array($siteDataObj)){
      foreach ($siteDataObj as $key => $currentSiteDataObj) {

        $currentSiteDataObj->status = incite_status_site_teaser_name($currentSiteDataObj->status);

        $currentSiteDataObj->stat_login = preg_replace("/\n|\r|\r\n|(\r\n)+/u", "<br />", $currentSiteDataObj->stat_login);

      }
      return $siteDataObj;
    }

    return false;
  }
}