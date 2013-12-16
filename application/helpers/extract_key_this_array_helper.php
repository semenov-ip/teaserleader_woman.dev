<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('extract_key_this_array')){

  function extract_key_this_array($array, $key){

    if(is_array($array) && !empty($key)){
    	return $array[$key];
    }

    return false;
  }
}