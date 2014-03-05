<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('isset_post_data_check')){

  function isset_post_data_check($postKeyArray){
    foreach ($postKeyArray as $value) {

      if( isset($_POST[$value]) ){ return true; }

    }

    return false;
  }
}