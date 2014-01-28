<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller{
  public $blockId, $referer;

  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->load->model('select_models');

    $dataWhereArr = Array (
      'block_id' => '1',
      'dataadd' => '1390766400'
    );

    $dbTableName = 'blocks_stat';

    var_dump($this->select_models->select_one_row_where_column_selectcolumn_query($dataWhereArr, 'view', $dbTableName) );
  }
}