<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Click_balance_update_debit_credit {
  public $ci, $referralId, $priceReferral;


  function __construct(){
    $this->ci =& get_instance();

    $this->priceReferral = 0;
  }

  function balanceUpdate($clickData){
    $this->advertiserBalanceDebit($clickData['logDataObj']->advertiser_id, $clickData['price']);

    $this->webmasterBalanceCredit($clickData['logDataObj']->webmaster_id, $clickData['price']);

    $this->referralBalanceCredit($clickData['logDataObj']->webmaster_id, $clickData['logDataObj']->advertiser_id, $clickData['price']);

    return $this->priceReferral;
  }

  function advertiserBalanceDebit($advertiserId, $price){
    $this->ci->update_models->update_set_one_where_column_debit($price, 'count_money', array('user_id' => $advertiserId), 'users');
  }

  function webmasterBalanceCredit($webmasterId, $price){
    $this->ci->update_models->update_set_one_where_column_credit($price, 'count_money', array('user_id' => $webmasterId), 'users');
  }

  function referralBalanceCredit($webmasterId, $advertiserId, $price){
    if($this->getReferralId($webmasterId, $price) != 0){

      $this->priceReferral = ( $price * $this->ci->config->item('referral_pct')) / 100;

      $this->ci->update_models->update_set_one_where_column_debit($this->priceReferral, 'count_money', array('user_id' => $advertiserId), 'users');

      $this->ci->update_models->update_set_one_where_column_credit($this->priceReferral, 'count_money', array('user_id' => $this->referralId), 'users');
    }
  }

  function getReferralId($webmasterId, $price){
    $dataWhereArr['user_id'] = $webmasterId;

    $this->referralId = extract_key_this_object($this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'referral', 'users'), 'referral');

    return $this->referralId;
  }
}