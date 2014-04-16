<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Site_pagination extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_all_row_where_foreach_column_selectcolumn_join_orderby_pagination($dataWhereArr, $orderbycolumn, $orderbycommand, $leftjoin, $equalityjoin, $selectcolumn, $perPagePagination, $from, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

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
      }

      return false;
    }

    function select_all_row_where_foreach_column_selectcolumn_join_orderby_return_count($dataWhereArr, $leftjoin, $equalityjoin, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

        if(!empty($dataWhereArr)){
          foreach ($dataWhereArr as $key => $where) {
            $this->db->or_where($where);
          }
        }

        $query = $this->db->get($this->prefixes.$dbTableName);

        return $query->num_rows();
      }

      return false;
    }
  }
?>