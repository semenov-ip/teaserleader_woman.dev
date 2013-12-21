<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('setup_array_noisset_data')){

  function setup_array_noisset_data($generalKeyValueArr, $setupTypeArrayCurrentKey){

    foreach ($setupTypeArrayCurrentKey as $value) {

      if( !isset($generalKeyValueArr[$value]) ) { $generalKeyValueArr[$value] = array(); }

    }

    return $generalKeyValueArr;
  }
}