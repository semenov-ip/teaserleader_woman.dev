<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

  function __construct(){

    parent::__construct();

    check_users_authentication();
  }

  public function index($referral = false) {
    $data['header'] = header_src_css_js('welcome', false);

    if($referral){ $this->session->set_userdata(array('referral' => $referral)); }

    $this->load->view('/welcome/welcome_tpl.php', $data);
  }
}