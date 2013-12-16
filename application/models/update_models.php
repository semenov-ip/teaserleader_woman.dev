<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class Update_models extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function update_set_one_where_column($dataUpdateArr, $dataWhereArr, $dbTableName){
      
      if(is_array($dataUpdateArr)){
      
        $this->db->where($dataWhereArr);

        return $this->db->update( $this->prefixes.$dbTableName, $dataUpdateArr );
      }

      return false;
    }
  }

?>