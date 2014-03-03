<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('foreach_bigarray_return_key_value')){

  function foreach_bigarray_return_key_value($bigarrayDataObj, $key, $valu){
    foreach ($bigarrayDataObj as $bigarray) {
      $keyValueArray[$bigarray->section_id] = $bigarray->section_name;
    }

    return $keyValueArray;
  }
}