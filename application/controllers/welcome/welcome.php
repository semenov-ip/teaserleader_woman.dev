<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

  function __construct(){

    parent::__construct();

    check_users_authentication();
  }

  public function index() {
    $data['header'] = header_src_css_js('welcome', false);

    if(isset($_GET['ref'])){ $this->session->set_userdata(array('referral' => htmlspecialchars(trim($_GET['ref'])))); }

    $this->load->view('/welcome/welcome_tpl.php', $data);
  }
}