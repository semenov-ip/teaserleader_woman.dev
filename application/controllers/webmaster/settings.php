<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Settings extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('header_src_css_js');

    $data['header'] = header_src_css_js('admin');
  }
}