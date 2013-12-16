<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class Insert_models extends CI_Model{
  
    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function insert_data_return_id($addDataArr, $dbTableName){
      if(is_array($addDataArr)){

        $this->db->insert($this->prefixes.$dbTableName, $addDataArr);

        return $this->db->insert_id();
      }

      return false;
    }
  }

?>