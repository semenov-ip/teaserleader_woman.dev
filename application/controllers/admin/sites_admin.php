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
    return $this->setDataProcessing($this->select_models->select_all_row_selectcilumn_orderby('site_id, url, status', 'status', 'asc', 'sites'));
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