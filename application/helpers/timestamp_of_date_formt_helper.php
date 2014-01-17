<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('timestamp_of_date_formt')){

  function timestamp_of_date_formt($dateSearch){

    if( !empty($dateSearch) ){

      return strtotime($dateSearch);

    }

    return 0;
  }
}