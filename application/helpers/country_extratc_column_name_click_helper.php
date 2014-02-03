<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('country_extratc_column_name_click')){

  function country_extratc_column_name_click($countryName){

    $countryKeyArr = array( 'RU_click' => 'RU', 'UA_click' => 'UA', 'BY_click' => 'BY', 'KZ_click' => 'KZ');

    $key = array_search($countryName, $countryKeyArr);

    if( $key !== false ){ return $key; }

    return "Other_click";
  }
}