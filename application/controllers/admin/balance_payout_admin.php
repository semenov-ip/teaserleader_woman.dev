<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Balance_payout_admin extends CI_Controller{

  private $who, $totalSumm;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();

    $this->totalSumm = array('summ' => 0);
  }

  function index(){
    $this->load->helper('status/incite_status_balance_name');
    $this->load->helper('select_define_builder');
    $this->load->helper('date2str');
    $this->load->helper('isset_post_data_check');
    $this->load->library('admin/data_builder_balance_html_elements');
    $this->load->model('update_models');

    $data = template_builder('admin', 'balance_payout_admin_tpl', $this->who);

    $data['balanceDataObj'] = $this->getBalanceDataObj();

    $data['balanceDataTotal'] = $this->totalSumm;

    $data = $this->data_builder_balance_html_elements->data($data);

    $data['error'] = extract_key_this_array( $this->config->item('error_message'), $this->getPostEventOperations());

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBalanceDataObj(){
    $dataWhereArr = ( isset($_POST['status']) && $_POST['status'] !== '-1') ? array( 'ch.status' => $_POST['status'] ) : array();

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn_join_orderby($dataWhereArr, "ch.dataadd", "desc", 'users lu', 'ch.user_id = lu.user_id', 'ch.user_id, ch.count_history_id, ch.description, ch.dataadd, ch.status, ch.trans_type, ch.summ, lu.email', 'count_history ch'));
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

    $this->totalSumm['summ'] = number_format($this->totalSumm['summ'], 2, '.', '');
  }

  function getPostEventOperations(){    
    if( isset_post_data_check(array('export_csv', 'move_treated', 'move_reject')) && isset($_POST['check']) ){

      $countHistoryIdArray = $_POST['check'];

      unset($_POST['check']);

      $countHistoryObj = $this->getCountHistoryObj($countHistoryIdArray);

      foreach ($_POST as $function => $nameValue) {

        if($countHistoryObj){ $this->$function($countHistoryObj); }

      }

    }
  }

  function getCountHistoryObj($countHistoryIdArray){
    return $this->select_models->select_from_where_in('count_history_id', $countHistoryIdArray, 'count_history');
  }

  function export_csv($countHistoryObj){
    @header("Content-Type: application/csv");
    @header("Content-Disposition: attachment; filename=\"payout.csv\"");

    $csv = '';

    foreach($countHistoryObj as $currentHistoryObj){

      $userDataObj = $this->getUserAllData( array('user_id' => $currentHistoryObj->user_id) );

      $csv .= $userDataObj->purse.';';
      $csv .= $currentHistoryObj->summ.';';
      $csv .= $this->config->item('paytitle').' - выплата по заказу - '.$userDataObj->email.';';
      $csv .= ''.$currentHistoryObj->count_history_id.''."\n";
    }

    echo $csv;
    exit();
  }

  function getUserAllData($dataWhereArr){
    return $this->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'email, name, purse, count_money', 'users');
  }

  function move_treated($countHistoryObj){ $this->updateStatus($countHistoryObj, '1'); }

  function move_reject($countHistoryObj){ $this->updateStatus($countHistoryObj, '2'); }

  function updateStatus($countHistoryObj, $status){
    foreach($countHistoryObj as $currentHistoryObj){
      $this->update_models->update_set_one_where_column( array('status' => $status), array('count_history_id'  => $currentHistoryObj->count_history_id), 'count_history' );
    }

    redirect( "/admin/balance_payout_admin/", 'location');
  }
}