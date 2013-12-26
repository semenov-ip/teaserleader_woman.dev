<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Show_query extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_one_from_where_column_selectcolumn_join($dataWhereArr, $selectcolumn, $dbTableName){

      if( is_array($dataWhereArr) ){
        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes."sites s", 'b.site_id = s.site_id');

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

    function select_all_from_campaign_banlike($geoLocation, $referer, $selectcolumn, $dbTableName){

      $this->db->select($selectcolumn);
      
      $this->db->not_like('ban_week_day', date("w"));

      $this->db->not_like('ban_hour', intval(date("H")));

      $this->db->not_like('ban_region', $geoLocation['region']);

      $this->db->not_like('ban_country', $geoLocation['country']);

      $this->db->not_like('ban_site', $referer);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result_array() as $row) {

          $dataQuery[] = $row;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_from_teaser_banlike($campaignDataObj, $banTeaser, $selectcolumn, $dbTableName){

      $this->db->select($selectcolumn);

      foreach ($campaignDataObj as $key => $dataWhereArr) {
        $this->db->where($dataWhereArr);
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
  }
?>