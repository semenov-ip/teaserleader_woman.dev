<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
  public $headerArr;

  function __construct(){

    parent::__construct();

    $this->load->helper('css_js');

    $this->headerArr = array(
      'css' => css_js('css', 'welcome'),
      'js' => css_js('js', 'welcome')
    );

  }

  public function index() {

    $data['header'] = $this->headerArr;
    
    $this->load->view('/welcome/welcome_tpl.php', $data);
  }
}