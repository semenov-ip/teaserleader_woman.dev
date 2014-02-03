<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Admin_statistiques_query extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_all_row_where_column_selectcolumn_join($dataWhereArr, $leftjoin, $equalityjoin, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() > 0){

          foreach ($query->result() as $row) {

            $dataQuery[] = $row;
            
          }

          return $dataQuery;
        }
      }

      return false;
    }
  }