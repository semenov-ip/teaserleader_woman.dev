<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_payout {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($countMoneyUser){

    if( $this->emptySummData() ){ return "empty_summ"; }

    if( $this->checkMinPayoutSumm() ){ return "check_min_payout_summ"; }

    if( $this->checkMinPayoutSumm() ){ return "check_min_payout_summ"; }

    if( $this->checkUserCountMoney($countMoneyUser) ){ return "check_user_count_money"; }

    return true;
  }

  function emptySummData(){
    if( empty($_POST['summ']) || $_POST['summ'] == '0.00' ){ return true; }

    return false;
  }

  function checkMinPayoutSumm(){
    if( $_POST['summ'] < $this->ci->config->item('min_payout') ){ return true; }

    return false;
  }

  function checkUserCountMoney($countMoneyUser){
    if( $_POST['summ'] > $countMoneyUser ){ return true; }

    return false;
  }
}