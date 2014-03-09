<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Balance_history extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();

    $this->totalSumm = array('incoming' => 0, 'expenditure' => 0);
  }

  function index(){
    $this->load->library('balance/validation_data_payout');
    $this->load->helper('status/incite_status_balance_name');
    $this->load->helper('date2str');
    $this->load->model('insert_models');
    $this->load->model('update_models');

    $data = template_builder('admin', 'balance_history_tpl', $this->who);

    $data['balanceDataObj'] = $this->getBalanceDataObj();

    $data['balanceDataTotal'] = $this->totalSumm;

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostDataPayoutAdd($data));

    $data['payoutDataObj'] = empty($_POST) ? (object)$this->getPayoutKey($data['count_money']) : (object)$_POST;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBalanceDataObj(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_orderby($dataWhereArr, "dataadd", "desc", 'description, dataadd, status, trans_type, summ', 'count_history'));
  }

  function setDataProcessing($balanceDataObj){
    if(is_array($balanceDataObj)){
      foreach ($balanceDataObj as $key => $currentBalanceDataObj) {

        $currentBalanceDataObj->dataadd = date2str($currentBalanceDataObj->dataadd);

        $currentBalanceDataObj->status = incite_status_balance_name($currentBalanceDataObj->status);

        $balanceDataObj[$key]->incoming = ($currentBalanceDataObj->trans_type) ? $currentBalanceDataObj->summ : "-";

        $balanceDataObj[$key]->expenditure = ($currentBalanceDataObj->trans_type) ? "-" : $currentBalanceDataObj->summ;

        $this->totalSum($currentBalanceDataObj->trans_type, $currentBalanceDataObj->summ);

      }

      return $balanceDataObj;
    }

    return false;
  }

  function totalSum($transType, $summ){
    if( $transType ){ return $this->totalSumm['incoming'] += $summ; }

    return $this->totalSumm['expenditure'] += $summ;
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