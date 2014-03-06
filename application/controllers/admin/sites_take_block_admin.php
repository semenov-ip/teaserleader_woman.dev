<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites_take_block_admin extends CI_Controller {

  private $who, $siteId, $status, $siteDataObj;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($siteId, $status){
    $this->load->helper('get_clean_data_form');
    $this->load->library('send_mail');
    $this->load->library('/admin/validation_data_sites_block');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->model('update_models');

    $this->getSiteId($siteId); $this->getStatusId($status);

    $data = template_builder('admin','sites_take_block_admin_tpl', $this->who, 'sites_admin');

    $data['siteDataObj'] = $this->getSiteData();

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteId($siteId){
    $this->siteId = $siteId;
  }

  function getStatusId($status){
    $this->status = $status;
  }

  function getSiteData(){
    $dataWhereArr['site_id'] = $this->siteId;

    return $this->checkDataImplementCurrentSite($this->select_models->select_one_row_where_column_selectcolumn_join($dataWhereArr, 'users lu', 'ls.user_id = lu.user_id', 'ls.user_id, ls.url, lu.email', 'sites ls'));
  }

  function checkDataImplementCurrentSite($siteDataObj){
    if(is_object($siteDataObj)){

      $siteDataObj->title = ($this->status == 1) ? "Приняте" : "Отклонение";

      $siteDataObj->text = ($this->status == 1) ? "принят." : "отклонен по причине";

      $this->siteDataObj = $siteDataObj;

      return $siteDataObj; 
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataSiteEdit();
  }

  function getPostDataSiteEdit(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_sites_block->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->addTicketUserSite($_POST)){

        $this->updateDataSiteStatus();

        $this->send_mail->sendMailMessage($this->siteDataObj->email, $_POST['title'], $_POST['text']);

        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "admin/sites_block_admin/index/$this->siteId/", 'location');
      }

    }

    return false;
  }

  function addTicketUserSite($addDataArr){
    $addDataArr['user_id'] = $this->siteDataObj->user_id;
    $addDataArr['dataadd'] = $this->config->item('datetime');
    $addDataArr['status'] = 1;
    $addDataArr['admin_status'] = 1;

    return $this->insert_models->insert_data_return_id($addDataArr, 'tickets');
  }

  function updateDataSiteStatus(){
    $dataUpdateArr['status'] = 3;
    $dataWhereArr['site_id'] = $this->siteId;

    return $this->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, 'sites');
  }
}