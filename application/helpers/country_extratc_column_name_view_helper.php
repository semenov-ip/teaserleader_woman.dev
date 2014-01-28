<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('country_extratc_column_name_view')){

  function country_extratc_column_name_view($countryName){

    $countryKeyArr = array( 'RU_view' => 'RU', 'UA_view' => 'UA', 'BY_view' => 'BY', 'KZ_view' => 'KZ');

    $key = array_search($countryName, $countryKeyArr);

    if( $key !== false ){ return $key; }

    return false;
  }
}