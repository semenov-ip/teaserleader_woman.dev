<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('header_src_css_js');
    $this->load->helper('template_builder');

    

    $data = template_builder();

    $data['header'] = header_src_css_js('admin');

    $data['menu'] = "/".$this->who."/menu/top_menu";

    $data['statistics'] = "/_shared/admin_statistics";

    $data['body'] = "/".$this->who."/sites_tpl.php"; 


    

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }
}