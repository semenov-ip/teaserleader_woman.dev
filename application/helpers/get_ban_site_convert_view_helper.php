<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_ban_site_convert_view')){

  function get_ban_site_convert_view($banSiteData){

    if( $banSiteData=="~" ){ return ""; }

    return preg_replace("/~/u", "\n", $banSiteData);
  }
}