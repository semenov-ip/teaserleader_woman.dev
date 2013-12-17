<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites_edit extends CI_Controller {

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index($sitesId){
    $this->load->helper('template_builder');

    $data = template_builder('admin','sites_tpl',$this->who,true);

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }
}