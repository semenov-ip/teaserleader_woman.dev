<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Statistiques_query extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_all_row_where_column_selectcolumn_count($dataWhereArr, $dbTableName){
      if( $dataWhereArr ){
        $this->db->select_sum('view');
        $this->db->select_sum('click');
        $this->db->select_sum('money');

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() > 0){

          foreach ($query->result_array() as $row) {

            foreach ($row as $key => $value) { if(is_null($row[$key])){ $row[$key] = "0"; } }

            return $row;
          }
        }
      }
      return false;
    }

    function select_all_row_where_and_where_or_column_selectcolumn($dataWhereArr, $selectcolumn, $dbTableName){
      if( is_array($dataWhereArr) ){

        $this->db->where($dataWhereArr);

        $this->db->select($selectcolumn);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() > 0){

          foreach ($query->result_array() as $row) {

            $dataQuery[] = $row;
          }

          return $dataQuery;
        }
      }

      return false;
    }
  }