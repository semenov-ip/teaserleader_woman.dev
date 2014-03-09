<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('check_users_authentication')){

  function check_users_authentication(){
    $ci =& get_instance();

    if( extract_key_this_array($ci->session->userdata('user'), 'hash') ){ 
      redirect( "/_shared/user_distributor/", 'location');
    }
  }
}