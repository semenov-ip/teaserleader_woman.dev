<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('current_dir_extract')){

  function current_dir_extract(){

    $currentUrl = explode( "/", $_SERVER['REQUEST_URI'] );

    return $currentUrl[1];
  }
}