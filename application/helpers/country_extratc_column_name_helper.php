<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('country_extratc_column_name')){

  function country_extratc_column_name($countryName){

    $countryKeyArr = array('RU', 'UA', 'BY', 'KZ');

    $key = array_search($countryName, $countryKeyArr);

    if( $key !== false ){ return $countryKeyArr[$key]; }

    return false;
  }
}