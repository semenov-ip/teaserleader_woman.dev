<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_new_password extends CI_Controller {

  function __construct(){

    parent::__construct();

  }

  public function index() {
    $this->load->helper('header_src_css_js');

    $data['header'] = header_src_css_js('welcome', false);
    
    $this->load->view('/welcome/get_new_password_tpl.php', $data);
  }
}