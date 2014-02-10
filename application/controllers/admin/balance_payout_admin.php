<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Balance_payout_admin extends CI_Controller{

  private $who, $totalSumm;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();

    $this->totalSumm = array('summ' => 0);
  }

  function index(){
    $this->load->helper('status/incite_status_balance_name');
    $this->load->helper('date2str');

    $data = template_builder('admin', 'balance_payout_admin_tpl', $this->who);

    $data['balanceDataObj'] = $this->getBalanceDataObj();

    $data['balanceDataTotal'] = $this->totalSumm;

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBalanceDataObj(){
    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_join_orderby(array(), "ch.dataadd", "desc", 'users lu', 'ch.user_id = lu.user_id', 'ch.user_id, ch.count_history_id, ch.description, ch.dataadd, ch.status, ch.trans_type, ch.summ, lu.email', 'count_history ch'));
  }

  function setDataProcessing($balanceDataObj){
    if(is_array($balanceDataObj)){
      foreach ($balanceDataObj as $key => $currentBalanceDataObj) {

        $currentBalanceDataObj->dataadd = date2str($currentBalanceDataObj->dataadd);

        $currentBalanceDataObj->status = incite_status_balance_name($currentBalanceDataObj->status);

        $this->totalSum($currentBalanceDataObj->summ);

      }

      return $balanceDataObj;
    }

    return false;
  }

  function totalSum($summ){
    $this->totalSumm['summ'] += $summ;

    $this->totalSumm['summ'] = number_format($this->totalSumm['summ'], 2);
  }
}