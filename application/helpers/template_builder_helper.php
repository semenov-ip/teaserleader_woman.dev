<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('template_builder')){

  function template_builder($template, $body, $who, $statisticsBoolean = false){
    $ci =& get_instance();

    $ci->load->helper('header_src_css_js');

    $data['header'] = header_src_css_js($template);

    $data['menu'] = "/$who/menu/top_menu";

    $data['body'] = "/$who/$body";

    if($statisticsBoolean) { $data['statistics'] = "/_shared/admin_statistics"; }

    return $data;
  }
}