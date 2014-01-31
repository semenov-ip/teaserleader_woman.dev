<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('data_where_user_id')){

  function data_where_user_id($who){
    $ci =& get_instance();

    return $who != "admin" ? array('user_id' => extract_key_this_array($ci->session->userdata('user'), 'user_id')) : array();
  }
}