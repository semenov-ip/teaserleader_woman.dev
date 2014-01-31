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

    function select_all_from_teaser_banlike_orderby($campaignDataObj, $orderbycolumn, $orderbycommand,  $limit, $banTeaser, $selectcolumn, $dbTableName){

      $this->db->select($selectcolumn);

      foreach ($campaignDataObj as $key => $dataWhereArr) {
        $this->db->or_where($dataWhereArr);
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