<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->helper('return_word_end');

    $data = template_builder('admin','sites_tpl',$this->who);

    $data['siteDataObj'] = $this->getSiteData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'site_id, url, status', 'sites'));
  }

  function setDataProcessing($siteDataObj){
    if(is_array($siteDataObj)){
      foreach ($siteDataObj as $key => $currentSiteDataObj) {

        $siteDataObj[$key]->playStatus = $currentSiteDataObj->status == 0 || $currentSiteDataObj->status == 3 ? "disabled" : "onclick=\"playPauseElement('".$currentSiteDataObj->site_id."', 'site_id', '".$currentSiteDataObj->status."', 'sites');\"";

        $currentSiteDataObj->status = incite_status_site_teaser_name($currentSiteDataObj->status);

        $siteDataObj[$key]->countBlock = return_word_end($this->select_models->select_count_where_fromtable(array('site_id' => $currentSiteDataObj->site_id), 'blocks'), '', 'блок', 'блока', 'блоков');

      }
      return $siteDataObj;
    }

    return false;
  }
}