<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('trim_stripslashes')){

  function trim_stripslashes($post){

    if(is_array($post)){
      
      foreach ($post as $key => $value) {

        $post[$key] = stripslashes(trim($value));
      }

      return $post;
    }
    

    return false;
  }
}