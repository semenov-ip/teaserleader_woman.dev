<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class User_pagination extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_all_row_whereforeach_selectcilumn_orderby_pagination($dataWhereArr, $select, $orderbycolumn, $orderbycommand, $perPagePagination, $from, $dbTableName){

      $this->db->select($select);

      $this->db->order_by($orderbycolumn, $orderbycommand);

      if(!empty($dataWhereArr)){
        foreach ($dataWhereArr as $key => $where) {
          $this->db->or_where($where);
        }
      }

      $query = $this->db->get($this->prefixes.$dbTableName, $perPagePagination, $from);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_row_whereforeach_selectcilumn_orderby_pagination_count($dataWhereArr, $select, $dbTableName){

      $this->db->select($select);

      if(!empty($dataWhereArr)){

        foreach ($dataWhereArr as $key => $where) {

          $this->db->or_where($where);

        }

      }

      $query = $this->db->get($this->prefixes.$dbTableName);

      return $query->num_rows();
    }
  }
?>