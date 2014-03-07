<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites_add extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index()
    $this->load->helper('select_define_builder');
    $this->load->helper('get_ban_site_convert_db');
    $this->load->helper('data_builder/foreach_bigarray_return_key_value');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('webmaster/data_builder_site_html_elements');
    $this->load->library('webmaster/validation_data_site');

    $data = template_builder('admin','sites_add_update_tpl',$this->who, 'sites');

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataSiteAdd() );

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'site_add_title' );

    $data['siteDataObj'] = empty($_POST) ? (object)$this->getSiteKey() : (object)$_POST;

    $data = $this->data_builder_site_html_elements->data($data);

    $data['desabledUrl'] = "";

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteKey(){
    return $this->select_models->show_columns_return_default('sites');
  }

  function getPostDataSiteAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_site->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->saveDataCollectionSite($_POST);
    }

    return false;
  }

  function saveDataCollectionSite($post){
    $post['dataadd'] = $this->config->item('datetime');

    $post['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $siteId = $this->insert_models->insert_data_return_id($post, 'sites');

    if($siteId){
      $this->session->set_flashdata('successSaveUpdateData', 'success_save_data');

      redirect( "/webmaster/sites/", 'location');
    }
  }
}