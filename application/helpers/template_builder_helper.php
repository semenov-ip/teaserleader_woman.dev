<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('template_builder')){

  function template_builder($template, $body, $who, $activeLink = false){
    $ci =& get_instance();

    $data = getUserDataObjHelper();

    $userdata = $ci->session->userdata('user');

    $data['header'] = header_src_css_js($template);

    $data['menu'] =  "/$who/menu/nav_menu";

    $data['body'] = "/".current_dir_extract()."/$body";

    $data['active_class'] = $activeLink == false ? $ci->router->fetch_class() : $activeLink;

    $data['ticketCount'] = getTicketCount($who);

    $data['who'] = $who;

    $data['userRedirected'] = isset($userdata['who']) ? '/'.$userdata['who'].'/menu/users_redirected_menu' : false;

    return $data;
  }

  function getUserDataObjHelper(){
    $ci =& get_instance();

    $dataWhereArr['hash'] = extract_key_this_array($ci->session->userdata('user'), 'hash');

    return (array) $ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'email, count_money, purse', 'users');
  }

  function getTicketCount($who){
    $ci =& get_instance();

    $dataWhereArr = ($who != "admin") ? array('user_id' => extract_key_this_array($ci->session->userdata('user'), 'user_id')) : array();

    ($who == "admin") ? $dataWhereArr['admin_status'] = 0 : $dataWhereArr['status'] = 1;

    $dataWhereArr['upid'] = 0;

    $count = $ci->select_models->select_from_where_column_selectcolumn_return_num_rows($dataWhereArr, 'user_id', 'tickets');

    if($count){ return "<span class='label label-success'>".$count."</span>"; }

    return "";
  }
}