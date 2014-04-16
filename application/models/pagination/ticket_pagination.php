<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Ticket_pagination extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_all_row_where_column_selectcolumn_orderby_pagination($dataWhereArr, $orderbycolumn, $orderbycommand, $selectcolumn, $perPagePagination, $from, $dbTableName){
      
      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        $this->db->select($selectcolumn);

        $this->db->order_by($orderbycolumn, $orderbycommand);

        $query = $this->db->get($this->prefixes.$dbTableName, $perPagePagination, $from);

        if($query->num_rows() > 0){

          foreach ($query->result() as $row) {

            $dataQuery[] = $row;
            
          }

          return $dataQuery;
        }
      }

      return false;
    }

    function select_all_row_where_column_selectcolumn_orderby_pagination_count($dataWhereArr, $selectcolumn, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        $this->db->select($selectcolumn);

        $query = $this->db->get($this->prefixes.$dbTableName);

        return $query->num_rows();
      }

      return false;
    }
  }
?>