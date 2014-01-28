<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class Delete_models extends CI_Model{

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');

    }

    function delete_one_where_column($dataWhereArr, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        return $this->db->delete( $this->prefixes.$dbTableName );
      }

      return false;
    }
  }