<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('header_src_css_js')){

  function header_src_css_js($template, $sharedBoolean = true){

    $ci =& get_instance();

    $ci->load->helper('css_js');

    return array(
      'css' => css_js('css', $template, $sharedBoolean),
      'js' => css_js('js', $template, $sharedBoolean)
    );

  }
}