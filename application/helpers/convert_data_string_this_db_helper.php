<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('convert_data_string_this_db')){

  function convert_data_string_this_db($generalArr, $setupTypeStringCurrentArray){

    foreach ($setupTypeStringCurrentArray as $value) {

      if( empty($generalArr[$value]) ) { 

        $generalArr[$value] = "~";

      } else{

        $generalArr[$value] = implode("~", $generalArr[$value]);

      }

    }

    return $generalArr;
  }
}