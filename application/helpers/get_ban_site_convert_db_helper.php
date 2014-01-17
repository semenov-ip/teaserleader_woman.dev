<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_ban_site_convert_db')){

  function get_ban_site_convert_db($banSiteData){
    if(!empty($banSiteData)){ return preg_replace("/\n|\r|\r\n|(\r\n)+/u", "~", $banSiteData); }

    return "~";
  }
}