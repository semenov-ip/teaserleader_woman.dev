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

        $this->db->join($this->prefixes."sections s", 'c.section_id = s.section_id');

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

    function update_set_several_where_column_plus_set_column($dataUpdateSetArr, $dataWhereArr, $dbTableName){

      if(is_array($dataUpdateSetArr)){

        $this->db->set('click', "click + 1", FALSE);

        foreach ($dataUpdateSetArr as $column => $valueUpdate) {
          $this->db->set($column, $column." + ".$valueUpdate, FALSE);
        }

        $this->db->where($dataWhereArr);

        return $this->db->update( $this->prefixes.$dbTableName );
      }

      return false;
    }
  }
?>