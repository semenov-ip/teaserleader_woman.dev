<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites_add extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('template_builder');
    $this->load->helper('trim_stripslashes');
    $this->load->helper('extract_key_this_array');
    $this->load->helper('select_define_builder');
    $this->load->model('select_models');
    $this->load->model('insert_models');

    $data = template_builder('admin','sites_add_update_tpl',$this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataSiteAdd() );

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'site_add_title' );

    $data['siteDataObj'] = empty($_POST) ? (object)$this->getSiteKey() : (object)$_POST;

    $data['selectChange'] = select_define_builder(array($data['siteDataObj']->url_encoding), array('utf8', 'cp1251', 'koi8r'));

    $data['desabledUrl'] = "";

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteKey(){
    return $this->select_models->show_columns('sites');
  }

  function getPostDataSiteAdd(){
    if(!empty($_POST)){

      $_POST = trim_stripslashes($_POST);
      
      if( !$this->urlCleanCheckEmptyInputData() ) return "empty_url";

      if( $this->urlConfirmDb($_POST['url']) ) return "url_confirm";

      $this->saveDataCollectionSite($_POST);
    }

    return false;
  }

  function urlCleanCheckEmptyInputData(){
    if( empty($_POST['url']) ) { return false; }

    $_POST['url'] = str_replace('http://', '', $_POST['url']);

    if(substr($_POST['url'], 0, 4) == 'www.') { $_POST['url'] = substr($_POST['url'], 4); }

    if( substr($_POST['url'], (strlen($_POST['url']) - 1)) == '/'){ $_POST['url'] = substr($_POST['url'], 0, (strlen($_POST['url']) - 1)); }

    return true;
  }

  function urlConfirmDb($urlUser){
    $whereEmalData['url'] = $urlUser;

    return $this->select_models->select_one_row_where_column($whereEmalData, 'sites');
  }

  function saveDataCollectionSite($post){
    $post['dataadd'] = $this->config->item('datetime');
    
    $post['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $siteId = $this->insert_models->insert_data_return_id($post, 'sites');

    if($siteId){
      $this->session->set_flashdata('successSaveUpdateData', 'success_save_data');

      redirect( "/webmaster/sites_edit/index/$siteId/", 'location');
    }
  }
}