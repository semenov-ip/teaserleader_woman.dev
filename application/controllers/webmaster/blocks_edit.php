<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks_edit extends CI_Controller {

  private $who, $blockId;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($blockId){
    $this->load->helper('trim_stripslashes_helper');
    $this->load->helper('select_define_builder');
    $this->load->model('update_models');
    $this->load->model('insert_models');
    $this->load->library('webmaster/data_builder_block_html_elements');
    $this->load->library('webmaster/validation_data_block');
    $this->load->library('webmaster/referral_code_builder');
    $this->load->library('block_style_builder');
    $this->load->library('show_block_preview');

    $this->getBlockId($blockId);

    $data = template_builder('admin','blocks_add_update_tpl', $this->who);

    $data['titleH4'] = extract_key_this_array( $this->config->item('title'), 'block_edit_title' );
    $data['titleMinor'] = extract_key_this_array( $this->config->item('title'), 'html_view' );
    $data['leftBlockHtml'] = true;

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->extractKeyErrorMessageInitializationPostQuery() );

    $data['blockDataObj'] = empty($_POST) ? $this->getBlockData() : (object)$_POST;

    $data = $this->data_builder_block_html_elements->data($data);

    $data['referralCode'] = $this->referral_code_builder->getReferralCode($blockId);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBlockId($blockId){
    $this->blockId = $blockId;
  }

  function getBlockData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    $dataWhereArr['block_id'] = $this->blockId;

    return $this->checkDataImplementCurrentBlock($this->select_models->select_one_row_where_column($dataWhereArr, 'blocks'));
  }

  function checkDataImplementCurrentBlock($blockDataObj){
    if(is_object($blockDataObj)){ 
      return $blockDataObj; 
    }

    redirect( "/_shared/user_distributor/", 'location'); 
  }

  function extractKeyErrorMessageInitializationPostQuery(){
    return $this->session->flashdata('successSaveUpdateData') ? $this->session->flashdata('successSaveUpdateData') : $this->getPostDataBlockEdit();
  }

  function getPostDataBlockEdit(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_block->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      if($this->updateDataCollectionBlock($_POST)){
        $this->session->set_flashdata('successSaveUpdateData', 'success_save_update_data');

        redirect( "/".$this->who."/blocks_edit/index/$this->blockId/", 'location');
      }
    }

    return false;
  }

  function updateDataCollectionBlock($post){
    $dataWhereArr['block_id'] = $this->blockId;
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->update_models->update_set_one_where_column($post, $dataWhereArr, 'blocks');
  }
}