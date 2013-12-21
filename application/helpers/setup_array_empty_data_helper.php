<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('setup_array_empty_data')){

  function setup_array_empty_data($generalKeyValueArr, $setupTypeArrayCurrentKey){

    foreach ($generalKeyValueArr as $key => $value) {

      if( in_array($key, $setupTypeArrayCurrentKey) && is_null($value) ){ $generalKeyValueArr[$key] = array(); }

    }

    return $generalKeyValueArr;
  }
}