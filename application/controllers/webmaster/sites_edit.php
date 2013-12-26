<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites_edit extends CI_Controller {

  private $who, $siteId;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($siteId){
    $this->load->helper('select_define_builder');
    $this->load->helper('trim_stripslashes');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->library('webmaster/data_builder_site_html_elements');

    $this->getSiteId($siteId);

    $data = template_builder('admin','sites_add_update_tpl',$this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'site_edit_title' );

    $data['siteDataObj'] = empty($_POST) ? $this->getSiteData() : (object)$_POST;

    $data = $this->data_builder_site_html_elements->data($data);

    $data['desabledUrl'] = "disabled";

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteId($siteId){
    $this->siteId = $siteId;
  }

  function getSiteData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $dataWhereArr['site_id'] = $this->siteId;

    return $this->checkDataImplementCurrentSite($this->select_models->select_one_row_where_column($dataWhereArr, 'sites'));
  }

  function checkDataImplementCurrentSite($siteDataObj){
    if(is_object($siteDataObj)){ return $siteDataObj; }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataSiteEdit();
  }

  function getPostDataSiteEdit(){
    if(!empty($_POST)){

      $_POST = trim_stripslashes($_POST);

      if($this->updateDataCollectionUserSite($_POST)){

        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/webmaster/sites_edit/index/$this->siteId/", 'location');
      }

    }

    return false;
  }

  function updateDataCollectionUserSite($post){
    unset($post['url']);
    
    $dataWhereArr['site_id'] = $this->siteId;
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'sites');
  }

}