<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Blocks extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');

    $data = template_builder('admin','blocks_tpl',$this->who);

    $data['blockDataObj'] = $this->getBlockData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBlockData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'block_id, name, hor, ver, status', 'blocks'));
  }

  function setDataProcessing($blockDataObj){
    if(is_array($blockDataObj)){

      foreach ($blockDataObj as $key => $currentBlockDataObj) {

        $currentBlockDataObj->status = incite_status_site_teaser_name($currentBlockDataObj->status);

        $currentBlockDataObj->itemsNumber = $currentBlockDataObj->ver * $currentBlockDataObj->hor;

      }

      return $blockDataObj;
    }

    return false;
  }
}