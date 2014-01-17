<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('extract_select_key_this_array')){

  function extract_select_key_this_array($generalArr, $needKeyArr){

    foreach ($generalArr as $needKey=>$needValue) {

      if(array_search( $needKey, $needKeyArr)){

        $generalReturnArr[$needKey] = $needValue;

      }

    }

    return $generalArr;
  }
}