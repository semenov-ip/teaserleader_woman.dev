<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){

    $data = template_builder('admin','sites_tpl',$this->who);

    


    $this->load->model('show/show_query');
    $dataWhereArr = array( 'b.block_id' => '5', 's.url' => "devexample.dev");
    $this->show_query->select_one_from_where_column_selectcolumn_join($dataWhereArr, 'b.block_id', 'blocks b');







    $this->load->view( '/_shared/admin_tpl.php', $data );









  }
}