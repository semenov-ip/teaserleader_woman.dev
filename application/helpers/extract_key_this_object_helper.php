<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('extract_key_this_object')){

  function extract_key_this_object($obj, $key){

    if(is_object($obj) && !empty($key)){
      return $obj->$key;
    }

    return false;
  }
}