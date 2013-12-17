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
    $this->load->model('select_models');
    $this->load->model('insert_models');

    $data = template_builder('admin','sites_add_update_tpl',$this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataSiteAdd() );

    $data['titleH4'] = extract_key_this_array( $this->config->item('error_message'), 'sites_add_title' );

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getPostDataSiteAdd(){
    if(!empty($_POST)){

      $_POST = trim_stripslashes($_POST);

      $_POST = $this->urlCleanEmptyInputData($_POST);
      
      if( !is_array($_POST) ) return "empty_url";

      if( $this->urlConfirmDb($_POST['url']) ) return "url_confirm";

      $this->saveDataCollectionUserSite($_POST);
    }

    return false;
  }

  function urlCleanEmptyInputData($post){
    if( empty($post['url']) ) { return false; }

    $post['url'] = str_replace('http://', '', $post['url']);

    if(substr($post['url'], 0, 4) == 'www.') { $post['url'] = substr($post['url'], 4); }

    if( substr($post['url'], (strlen($post['url']) - 1)) == '/'){ $post['url'] = substr($post['url'], 0, (strlen($post['url']) - 1)); }

    return $post;
  }

  function urlConfirmDb($urlUser){
    $whereEmalData['url'] = $urlUser;

    return $this->select_models->select_one_row_where_column($whereEmalData, 'sites');
  }

  function saveDataCollectionUserSite($post){
    $post['dataadd'] = $this->config->item('datetime');

    $post['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $idUser = $this->insert_models->insert_data_return_id($post, 'sites');

    if($idUser){
      redirect( "/webmaster/sites/", 'location'); 
    }
  }
}