<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Balance_payout extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->library('balance/validation_data_payout');
    $this->load->model('insert_models');
    $this->load->model('update_models');

    $data = template_builder('admin', 'balance_payout_tpl', $this->who);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataPayoutAdd($data));

    $data['payoutDataObj'] = empty($_POST) ? (object)$this->getPayoutKey($data['count_money']) : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getPayoutKey($countMoneyUser){
    return array('summ' => $countMoneyUser);
  }

  function getPostDataPayoutAdd($data){
    if(!empty($_POST)){

      $submitStatus = $this->validation_data_payout->getCorrectData($data['count_money']);

      if( $submitStatus !== true ){ return $submitStatus; }

      $this->savePayoutData($_POST, $data['purse']);
    }

    return false;
  }

  function savePayoutData($addDataArr, $purse){
    $addDataArr['description'] = "Выплата на WebMoney кошелёк ".$purse;
    $addDataArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $countHistoryId = $this->insert_models->insert_data_return_id($addDataArr, 'count_history');

    if($countHistoryId){

      $this->updateUserBalance($addDataArr['summ']);

      redirect("/balance/balance_history/", 'location');

    }
  }

  function updateUserBalance($summ){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    $this->update_models->update_set_one_where_column_debit($summ, 'count_money', $dataWhereArr, 'users');
  }
}