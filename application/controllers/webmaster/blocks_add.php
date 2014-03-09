<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Blocks_add extends CI_Controller{

  private $who, $siteId;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($siteId){
    $this->load->helper('trim_stripslashes_helper');
    $this->load->helper('select_define_builder');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->library('check_campaign_blocks_id_current_user');
    $this->load->library('block_style_builder');
    $this->load->library('show_block_preview');
    $this->load->library("webmaster/data_builder_block_html_elements");
    $this->load->library("webmaster/validation_data_block");

    $this->check_campaign_blocks_id_current_user->checkBlocks($siteId);

    $this->getSiteId($siteId);

    $data = template_builder('admin','blocks_add_update_tpl', $this->who, 'blocks');

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'block_add_title' );
    $data['titleMinor'] = extract_key_this_array( $this->config->item('title'), 'block_view' );
    $data['leftBlockHtml'] = false;

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataBlockAdd() );

    $data['blockDataObj'] = empty($_POST) ? (object)$this->getBlockKey() : (object)$_POST;

    $data = $this->data_builder_block_html_elements->data($data);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteId($siteId){
    $this->siteId = $siteId;
  }

  function getBlockKey(){
    return $this->setUpDefaultsValue($this->select_models->show_columns_return_default('blocks'));
  }

  function setUpDefaultsValue($blockDataObj){
    $blockDataObj['name'] = "Блок #".($this->select_models->select_from_where_column_selectcolumn_return_num_rows(array('site_id' => $this->siteId), 'block_id', 'blocks') + 1);

    return $blockDataObj;
  }

  function getPostDataBlockAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_block->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      return $this->saveDataCollectionBlock($_POST);
    }

    return false;
  }

  function saveDataCollectionBlock($post){
    $post['second_link'] = isset($post['second_link']) ? 1 : 0;
    $post['site_id'] = $this->siteId;
    $post['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $post['dataadd'] = $this->config->item('datetime');

    $blockId = $this->insert_models->insert_data_return_id($post, 'blocks');

    if($blockId){
      $this->session->set_flashdata('successSaveUpdateData', 'success_save_data');

      redirect( "/webmaster/blocks_edit/index/$blockId/", 'location');
    }
  }
}