<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Tiser_query extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }
  }
?>