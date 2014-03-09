<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('trim_stripslashes')){

  function trim_stripslashes($post, $exceptionsKey = array()){

    if(is_array($post)){
      
      foreach ($post as $key => $value) {

        if(!in_array($key, $exceptionsKey)){

          $post[$key] = stripslashes(trim($value));
          
        }
      }

      return $post;
    }

    return false;
  }
}