<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_block extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->model('/statistiques/statistiques_query');
    $this->load->model('select_models');
    $this->load->library('/statistiques/statistiques_count_data');

    $data = template_builder('admin','statistiques_block_tpl',$this->who);

    $data['blockStatistiqDataArr'] = $this->getBlockStatistiqDataArr();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getBlockStatistiqDataArr(){

    $statistiqConfig = array(
      'select_column' => 'block_id, name',
      'table_name' => 'blocks',
      'column_id' => 'block_id',
    );

    return $this->statistiques_count_data->getStatistiqCount($statistiqConfig);

  }
}