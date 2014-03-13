<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('convert_data_array_this_db')){

  function convert_data_array_this_db($generalArr, $setupTypeStringCurrentArray){

    foreach ($setupTypeStringCurrentArray as $value) {

      if( is_null($generalArr->$value) || $generalArr->$value == "~" ) {

        $generalArr->$value = array();

      } else{

        $generalArr->$value = explode("~", $generalArr->$value);

      }

    }

    return $generalArr;
  }


  function convert_one_data_array($setupTypeStringCurrentArray){
    return explode("~", $setupTypeStringCurrentArray);
  }
}