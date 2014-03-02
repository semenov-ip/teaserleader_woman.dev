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

    $data['newsCount'] = getNewsCount();

    $data['who'] = $who;

    $data['userRedirected'] = isset($userdata['who']) ? '/'.$userdata['who'].'/menu/users_redirected_menu' : false;

    if(isset($userdata['who'])){ $data['statusModerateBlock'] = getUserAcceptBlock(); }

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

  function getUserAcceptBlock(){
    $status = extract_key_this_object(getUserStatus(), 'status');

    return ($status == 0 || $status == 3) ? statusModerate() : statusBlock();
  }

  function getUserStatus(){
    $ci =& get_instance();

    return $ci->select_models->select_one_row_where_column_selectcolumn(array('user_id' => extract_key_this_array($ci->session->userdata('user'), 'user_id')), 'status', 'users');
  }

  function statusModerate(){
    $ci =& get_instance();

    return "<a title='Принять' class='display-i-b' onclick=\"statusModerateBlock('".extract_key_this_array($ci->session->userdata('user'), 'user_id')."', 'user_id', '1', 'users')\" href='#'><i class='icon-ok font-size-20'></i></a>";
  }

  function statusBlock(){
    $ci =& get_instance();

    return "<a title='Заблокировать' class='display-i-b' onclick=\"statusModerateBlock('".extract_key_this_array($ci->session->userdata('user'), 'user_id')."', 'user_id', '3', 'users')\" href='#'><i class='icon-minus-sign font-size-20'></i></a>";
  }

  function getNewsCount(){
    $ci =& get_instance();

    $dataWhereArr = array('user_id' => extract_key_this_array($ci->session->userdata('user'), 'user_id'));

    $count = $ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'status_news', 'users');

    if($count->status_news){ return "<span class='label label-success'>".$count->status_news."</span>"; }

    return "";
  }
}