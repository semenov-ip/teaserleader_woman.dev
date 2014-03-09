<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class News extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('date2str');
    $this->load->model('update_models');

    $data = template_builder('admin','admin_news_tpl', $this->who);

    $data['newsDataObj'] = $this->newsDataObj();

    $this->updateCountNews();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function newsDataObj(){
    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_orderby(array(), 'dataadd', 'desc', 'title, text, dataadd', 'news'));
  }

  function setDataProcessing($newsDataObj){
    if(is_array($newsDataObj)){

      foreach ($newsDataObj as $key => $currentNewsDataObj) {

        $currentNewsDataObj->dataadd = date2str($currentNewsDataObj->dataadd);

      }

      return $newsDataObj;
    }

    return false;
  }

  function updateCountNews(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $this->update_models->update_set_one_where_column(array('status_news' => 0), $dataWhereArr, 'users');
  }
}