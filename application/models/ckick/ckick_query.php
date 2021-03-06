<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Ckick_query extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_one_from_where_column_selectcolumn_join($dataWhereArr, $selectcolumn, $dbTableName){

      if( is_array($dataWhereArr) ){
        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes."sections sec", 'sit.section_id = sec.section_id');

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() == 1){

          foreach ($query->result() as $row) {

            return $row;
          }

        }
      }

      return false;
    }

    function update_set_several_where_column_plus_set_column($dataUpdateSetArr, $dataWhereArr, $incrementColumn, $dbTableName){

      if(is_array($dataUpdateSetArr)){

        $this->db->set($incrementColumn, $incrementColumn." + 1", FALSE);

        foreach ($dataUpdateSetArr as $column => $valueUpdate) {

          $this->db->set($column, $column." + ".$valueUpdate, FALSE);

        }

        $this->db->where($dataWhereArr);

        return $this->db->update( $this->prefixes.$dbTableName );
      }

      return false;
    }

    function select_limit_row_where_column_selectcolumn_return_stat_id($dataWhereArr, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select('stat_id');

        $this->db->limit(1);

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() == 1){

          foreach ($query->result() as $row) {

            return $row->stat_id;
          }

        }

      }

      return false;
    }
  }
?>