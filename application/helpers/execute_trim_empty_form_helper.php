<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('execute_trim_empty_form')){

  function execute_trim_empty_form($post){

    foreach ($post as $key => $value) {

      $post[$key] = trim($value);

      if( empty($post[$key]) ){

        return false;
      }

    }

    return true;
  }
}