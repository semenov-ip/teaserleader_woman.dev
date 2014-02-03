<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Balance_payout_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();

    $this->totalSumm = array('incoming' => 0, 'expenditure' => 0);
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
    $dataWhereArr['trans_type'] = 0;

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
}