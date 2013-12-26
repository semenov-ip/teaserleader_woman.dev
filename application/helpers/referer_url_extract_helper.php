<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('referer_url_extract')){

  function referer_url_extract($referer){

    if(empty($referer)){ return ""; }

    $referer_url = '';

    if(substr($referer, 0 , 7) == 'http://'){
      $referer_url = substr($referer, 7);
    }

    $referer_url_pos = strpos($referer_url, '/');

    if($referer_url_pos){
      $referer_url = substr($referer_url, 0, $referer_url_pos);
    }

    if(substr($referer_url, 0 , 4) == 'www.'){
      $referer_url = substr($referer_url, 4);
    }

    return $referer_url;
  }
}