<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Teasers extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');

    $data = template_builder('admin','teasers_tpl', $this->who);

    $data['teaserDataObj'] = $this->getTeaserData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getTeaserData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'teaser_id, image, url, text, status', 'teasers'));
  }

  function setDataProcessing($teaserDataObj){
    if(is_array($teaserDataObj)){

      foreach ($teaserDataObj as $key => $currentTeaserDataObj) {

        $currentTeaserDataObj->status = incite_status_site_teaser_name($currentTeaserDataObj->status);

      }

      return $teaserDataObj;
    }

    return false;
  }
}