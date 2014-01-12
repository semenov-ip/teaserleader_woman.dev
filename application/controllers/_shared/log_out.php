<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_out extends CI_Controller{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->session->sess_destroy();

    redirect( "/welcome/", 'location');
  }
}