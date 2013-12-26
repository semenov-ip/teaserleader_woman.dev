<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('template_builder')){

  function template_builder($template, $body, $who){
    $ci =& get_instance();

    $ci->load->helper('header_src_css_js');

    $data = getUserDataObjHelper();

    $data['header'] = header_src_css_js($template);

    $data['menu'] =  "/$who/menu/nav_menu";

    $data['body'] = "/".current_dir_extract()."/$body";

    return $data;
  }

  function getUserDataObjHelper(){
    $ci =& get_instance();

    $dataWhereArr['hash'] = extract_key_this_array($ci->session->userdata('user'), 'hash');

    return (array) $ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'email, count_rur', 'users');
  }
}