<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Show_query extends CI_Model{

    protected $prefixes;

    function __construct(){

      parent::__construct();

      $this->prefixes = $this->config->item('prefixes');
    }

    function select_one_from_where_column_selectcolumn_join($dataWhereArr, $domain, $selectcolumn, $dbTableName){

      if( is_array($dataWhereArr) ){
        $this->db->select($selectcolumn);

        $this->db->join($this->prefixes."sites s", 'b.site_id = s.site_id');

        $this->db->where($dataWhereArr);

        $this->db->where('s.url', $domain);

        $query = $this->db->get($this->prefixes.$dbTableName);

        if($query->num_rows() > 0){

          foreach ($query->result() as $row) {

            return $row;
          }

        }
      }

      return false;
    }

    function select_all_from_campaign_banlike($dataWhereArr, $geoLocation, $referer, $selectcolumn, $dbTableName){

      $this->db->select($selectcolumn);

      $this->db->not_like('ban_week_day', date("w"));

      $this->db->not_like('ban_hour', intval(date("H")));

      if( is_array($geoLocation) ){

        $this->db->not_like('ban_region', $geoLocation['region']);

        $this->db->not_like('ban_country', $geoLocation['country']);

      }

      $this->db->not_like('ban_site', $referer);

      $this->db->where('status', 1);

      $this->db->where($dataWhereArr);

      $query = $this->db->get($this->prefixes.$dbTableName);

      if($query->num_rows() > 0){

        foreach ($query->result_array() as $row) {

          $dataQuery[] = $row;
        }

        return $dataQuery;
      }

      return false;
    }

    function select_all_from_teaser_banlike_orderby($campaignDataObj, $sectionId, $orderbycolumn, $orderbycommand, $limit, $banTeaser, $selectcolumn, $dbTableName){

      $dataQuery = array();

      $this->db->select($selectcolumn);

      if( !empty($banTeaser) ){
        $banTeaserDataArray = (strpos($banTeaser, ',')  === false) ? array($banTeaser) : explode( ',', $banTeaser );

        $banTeaserDataArray = trim_stripslashes($banTeaserDataArray);
      }

      foreach ($campaignDataObj as $key => $dataWhereArr) {

        $this->db->or_where($dataWhereArr);

        $this->db->where('status', 1);

        if( isset($banTeaserDataArray) ){ $this->db->where_not_in('teaser_id', $banTeaserDataArray); }
      }

      $this->db->order_by($orderbycolumn, $orderbycommand);

      $query = $this->db->get($this->prefixes.$dbTableName);
      
      if($query->num_rows() > 0){

        foreach ($query->result() as $row) {

          if(in_array($sectionId, convert_one_data_array($row->section_id))){

            $dataQuery[] = $row;

            if( count($dataQuery) >= $limit ) break;

          }

        }

        return !empty($dataQuery) ? $dataQuery : false;
      }

      return false;
    }

    function update_set_several_where_column_plus_set_column($dataWhereArr, $incrementColumn, $dbTableName){

      if(is_array($dataWhereArr)){

        $this->db->set($incrementColumn, $incrementColumn." + 1", FALSE);

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

    function create_table_log($dbTableName){

      $this->load->dbforge();

      $fields = array(
        'log_id' => array( 'type' => 'bigint', 'constraint' => 11, 'auto_increment' => TRUE ),

        'advertiser_id' => array( 'type' => 'int', 'constraint' => 7 ),

        'webmaster_id' => array( 'type' => 'int', 'constraint' => 7 ),

        'site_id' => array( 'type' => 'int', 'constraint' => 7 ),

        'block_id' => array( 'type' => 'int', 'constraint' => 7 ),

        'campaign_id' => array( 'type' => 'int', 'constraint' => 7 ),

        'teaser_id' => array( 'type' => 'int', 'constraint' => 7 ),

        'country' => array( 'type' => 'varchar', 'constraint' => 32 ),

        'hash' => array( 'type' => 'varchar', 'constraint' => 32 )
      );

      $this->dbforge->add_key('log_id', TRUE);
      $this->dbforge->add_key('advertiser_id', TRUE);
      $this->dbforge->add_key('webmaster_id', TRUE);
      $this->dbforge->add_key('block_id', TRUE);
      $this->dbforge->add_key('teaser_id', TRUE);

      $this->dbforge->add_key(array('hash'));

      $this->dbforge->add_field($fields);

      $this->dbforge->create_table($this->prefixes.$dbTableName, true);
    }
  }
?>