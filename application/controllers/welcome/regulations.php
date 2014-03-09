<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regulations extends CI_Controller {

  function __construct(){

    parent::__construct();

    check_users_authentication();
  }

  public function index() {
    $data['header'] = header_src_css_js('welcome', false);

    $this->load->view('/welcome/regulations_tpl.php', $data);
  }
}