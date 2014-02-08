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
    $this->load->model('statistiques/admin_statistiques_query');

    $data = template_builder('admin','sites_admin_tpl',$this->who);

    $data['siteDataObj'] = $this->getSiteAllData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteAllData(){
    $dataWhereArr = array();

    return $this->setDataProcessing($this->admin_statistiques_query->select_all_row_where_column_selectcolumn_join($dataWhereArr, 'users lu', 'ls.user_id = lu.user_id', 'ls.site_id, ls.user_id, ls.status, ls.url, lu.email', 'sites ls'));
  }

  function setDataProcessing($siteDataObj){
    if(is_array($siteDataObj)){
      foreach ($siteDataObj as $key => $currentSiteDataObj) {

        $siteDataObj[$key]->statusModerateBlock = $currentSiteDataObj->status == 0 || $currentSiteDataObj->status == 3 ? $this->statusModerate($currentSiteDataObj) : $this->statusBlock($currentSiteDataObj);

        $currentSiteDataObj->status = incite_status_site_teaser_name($currentSiteDataObj->status);

      }
      return $siteDataObj;
    }

    return false;
  }

  function statusModerate($currentSiteDataObj){
    return "<button title='Принять' class='btn btn-default btn-xs' onclick=\"statusModerateBlock('".$currentSiteDataObj->site_id."', 'site_id', '1', 'sites')\"><i class='icon-ok'></i> </button>";
  }

  function statusBlock($currentSiteDataObj){
    return "<button title='Заблокировать' class='btn btn-default btn-xs' onclick=\"statusModerateBlock('".$currentSiteDataObj->site_id."', 'site_id', '3', 'sites')\"><i class='icon-minus-sign'></i> </button>";
  }
}