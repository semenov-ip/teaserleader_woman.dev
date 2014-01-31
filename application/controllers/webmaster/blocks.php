<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Blocks extends CI_Controller{

  private $who, $siteId;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($siteId=false){
    $this->load->helper('status/incite_status_site_teaser_name');

    $this->getSiteId($siteId);

    $data = template_builder('admin','blocks_tpl',$this->who);

    $data['blockDataObj'] = $this->getBlockData();

    $data['addBlockButtonSiteId'] = $this->siteId;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteId($siteId){
    $this->siteId = $siteId;
  }

  function getBlockData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    if( $this->siteId ) { $dataWhereArr['site_id'] = $this->siteId; }

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'block_id, name, hor, ver, status', 'blocks'));
  }

  function setDataProcessing($blockDataObj){
    if(is_array($blockDataObj)){

      foreach ($blockDataObj as $key => $currentBlockDataObj) {

        $blockDataObj[$key]->playStatus = $currentBlockDataObj->status == 0 ? "disabled" : "onclick=\"playPauseElement('".$currentBlockDataObj->block_id."', 'block_id', '".$currentBlockDataObj->status."', 'blocks');\"";

        $currentBlockDataObj->status = incite_status_site_teaser_name($currentBlockDataObj->status);

        $currentBlockDataObj->itemsNumber = $currentBlockDataObj->ver * $currentBlockDataObj->hor;

      }

      return $blockDataObj;
    }

    return false;
  }
}