<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('extract_select_key_this_moneycountry')){

  function extract_select_key_this_moneycountry($country){

    $moneyRuArray = array('RU');

    $moneySngArray = array('UA', 'BY', 'KZ', 'Other');

    if( in_array($country, $moneyRuArray) ){ return "money_ru"; }

    if( in_array($country, $moneySngArray) ){ return "money_sng"; }

    return false;
  }
}