<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Select_models extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_all_row_selectcilumn($select, $dbTableName){
      $this->db->select($select);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_row_selectcilumn_orderby($select, $orderbycolumn, $orderbycommand, $dbTableName){
      $this->db->select($select);

      $this->db->order_by($orderbycolumn, $orderbycommand);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_row_whereforeach_selectcilumn_orderby($dataWhereArr, $select, $orderbycolumn, $orderbycommand, $dbTableName){
      $this->db->select($select);

      $this->db->order_by($orderbycolumn, $orderbycommand);

      if(!empty($dataWhereArr)){
        foreach ($dataWhereArr as $key => $where) {
          $this->db->or_where($where);
        }
      }

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;
        }

        return $dataQuery;
      }

      return false;
    }


    function select_one_row_where_column($dataWhereArr, $dbTableName){

      if(is_array($dataWhereArr)){

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

    function select_one_row_where_column_selectcolumn($dataWhereArr, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

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

    function select_limit_row_where_column_selectcolumn($dataWhereArr, $selectcolumn, $limit, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->limit($limit);

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

    function select_all_row_where_column($dataWhereArr, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() > 0){

          foreach ($query->result() as $row) {

            $dataQuery[] = $row;
          }

        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_row_where_column_selectcolumn($dataWhereArr, $selectcolumn, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        $this->db->select($selectcolumn);

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

    function select_all_row_where_column_selectcolumn_return_arr($dataWhereArr, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

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

    function select_all_row_or_where_column_selectcolumn($dataWhereArr, $selectcolumn, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->or_where($dataWhereArr);

        $this->db->select($selectcolumn);

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

    function select_all_row_where_or_where_column_selectcolumn($dataORWhereArr, $dataANDWhereArr, $selectcolumn, $dbTableName){

      if(is_array($dataORWhereArr)){

        foreach ($dataORWhereArr as $key => $value) {
          $this->db->or_where($key, $value);

          $this->db->where($dataANDWhereArr);
        }

        $this->db->select($selectcolumn);

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

    function select_all_row_where_column_selectcolumn_orderby($dataWhereArr, $orderbycolumn, $orderbycommand, $selectcolumn, $dbTableName){
      
      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        $this->db->select($selectcolumn);

        $this->db->order_by($orderbycolumn, $orderbycommand);

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

    function select_all_row_selectcolumn_return_key_value($selectcolumn, $key, $value, $dbTableName){

      $this->db->select($selectcolumn);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[$row->$key] = $row->$value;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_row_selectcolumn_return_key_value_orderby($selectcolumn, $key, $value, $orderby, $dbTableName){

      $this->db->select($selectcolumn);

      $this->db->group_by($key);

      $this->db->order_by("BINARY($value)", $orderby);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[$row->$key] = $row->$value;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_row_where_column_selectcolumn_orderby_groupby($dataWhereArr, $selectcolumn, $orderby, $dbTableName){
      $this->db->select($selectcolumn);
      
      $this->db->group_by($selectcolumn);

      $this->db->order_by("BINARY($selectcolumn)", $orderby);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {
          if(!empty($row->$selectcolumn)){

            $dataQuery[] = $row->$selectcolumn;
          }

        }

        return $dataQuery;
      }

      return false;
    }

    function select_from_where_column_selectcolumn_return_num_rows($dataWhereArr, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->where($dataWhereArr);

        $this->db->select($selectcolumn);

        $query = $this->db->get($this->prefixes.$dbTableName);

        return $query->num_rows();
      }

      return 0;
    }

    function select_count_where_fromtable($dataWhereArr, $dbTableName){
      if( is_array($dataWhereArr) ){
        $this->db->where($dataWhereArr);

        return $this->db->count_all_results($this->prefixes.$dbTableName);
      }
      
      return false;
    }

    function select_mindata_where_fromtable($dataWhereArr, $mincolumn, $dbTableName){
      
      $this->db->select_min($mincolumn);

      $this->db->where($dataWhereArr);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() == 1){

        foreach ($query->result() as $row) {

          return $row->$mincolumn;

        }
      }
      return false;
    }

    function select_one_row_where_column_selectcolumn_join($dataWhereArr, $leftjoin, $equalityjoin, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() == 1){

          foreach ($query->result() as $row) {

            return $row;
            
          }

          return $dataQuery;
        }
      }

      return false;
    }

    function select_all_row_where_column_selectcolumn_join_orderby($dataWhereArr, $orderbycolumn, $orderbycommand, $leftjoin, $equalityjoin, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

        $this->db->order_by($orderbycolumn, $orderbycommand);

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

    function select_all_row_where_foreach_column_selectcolumn_join_orderby($dataWhereArr, $orderbycolumn, $orderbycommand, $leftjoin, $equalityjoin, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

        $this->db->order_by($orderbycolumn, $orderbycommand);

        if(!empty($dataWhereArr)){
          foreach ($dataWhereArr as $key => $where) {
            $this->db->or_where($where);
          }
        }

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

    function select_all_row_where_foreach_column_selectcolumn_join_orderby_return_count($dataWhereArr, $orderbycolumn, $orderbycommand, $leftjoin, $equalityjoin, $selectcolumn, $dbTableName){
      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes.$leftjoin, $equalityjoin);

        $this->db->order_by($orderbycolumn, $orderbycommand);

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

    function select_from_all_limit_orderby($limit, $orderbycolumn, $orderbycommand, $dbTableName){

      $this->db->limit($limit);

      $this->db->order_by($orderbycolumn, $orderbycommand);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;
          
        }

        return $dataQuery;
      }

      return false;
    }

    function select_from_where_in_limit_orderby($whereincolumn, $dataWhereArr, $limit, $orderbycolumn, $orderbycommand, $dbTableName){

      if( !empty($dataWhereArr) ){
        $this->db->where_in($whereincolumn, $dataWhereArr);
      }

      $this->db->limit($limit);

      $this->db->order_by($orderbycolumn, $orderbycommand);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;
          
        }

        return $dataQuery;
      }

      return false;
    }

     function select_from_where_in($whereincolumn, $dataWhereArr, $dbTableName){

      if( !empty($dataWhereArr) ){
        $this->db->where_in($whereincolumn, $dataWhereArr);
      }

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          $dataQuery[] = $row;

        }

        return $dataQuery;
      }

      return false;
    }

    function show_columns($dbTableName){

      $fields = $this->db->list_fields($this->prefixes.$dbTableName);

      foreach ($fields as $field) {
        $row[$field] = null;
      }

      return $row;
    }

    function show_columns_return_default($dbTableName){
      $fields = $this->db->field_data($this->prefixes.$dbTableName);

      foreach ($fields as $field){
        $row[$field->name] = $field->default;
      }

      return $row;
    }

    function database_exists_dbname($dbTableName){
      return $this->db->table_exists($this->prefixes.$dbTableName);
    }

    function selectcolumn_limit_where_return_boolean($dataWhereArr, $selectcolumn, $limit, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->select($selectcolumn);

        $this->db->limit($limit);

        $this->db->where($dataWhereArr);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() == 1){

          return true;
        }

      }

      return false;
    }
  }
?>