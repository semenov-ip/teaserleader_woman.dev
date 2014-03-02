<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class News_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->library('/admin/validation_data_news');
    $this->load->library('send_mail');
    $this->load->model('select_models');
    $this->load->model('insert_models');
    $this->load->model('update_models');

    $data = template_builder('admin','news_admin_tpl', $this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataNewsAdd() );

    $data['newsDataObj'] = empty($_POST) ? (object)$this->getNewsKey() : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getNewsKey(){
    return $this->addtodayDate($this->select_models->show_columns('news'));
  }

  function addtodayDate($newsDataObj){
    $newsDataObj['dataadd'] = date('d-m-Y');

    return $newsDataObj;
  }

  function getPostDataNewsAdd(){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_news->getCorrectData();

      if( $submitStatus !== true ){ return $submitStatus; }

      if( isset($_POST['mailsend']) ){ $this->sendMailNewsData($_POST); }

      unset($_POST['mailsend']);

      $this->saveNewsData($_POST);
    }

    return false;
  }

  function sendMailNewsData($sendDataArr){
    $userDataObj = $this->getUserDataObj();

    $from = 'no-reply@'.$this->config->item('url');

    foreach ($userDataObj as $key => $userEmail) {

      $this->send_mail->sendMailMessage($userEmail->email, $sendDataArr['title'], $sendDataArr['text'], $from );

      $this->update_models->update_set_one_where_column_credit(1, 'status_news', array('user_id' => $userEmail->user_id), 'users');
    }
  }

  function getUserDataObj(){
    return $this->select_models->select_all_row_selectcilumn('user_id, email', 'users');
  }

  function saveNewsData($addDataArr){
    $addDataArr['dataadd'] = date("Y-m-d H:i:s", strtotime($addDataArr['dataadd']));

    $ticketId = $this->insert_models->insert_data_return_id($addDataArr, 'news');

    if($ticketId){
      redirect( "/_shared/news/", 'location');
    }
  }
}