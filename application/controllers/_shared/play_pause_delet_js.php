<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Play_pause_delet_js extends CI_Controller{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->load->helper('get_clean_data_form');
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->model('update_models');

    if(isset($_POST['data'])){
      $dataEvent = get_clean_data_form($_POST['data']);

      if($this->updateDataInterface($dataEvent)){
        echo json_encode( incite_status_site_teaser_name($dataEvent['status']) );
      }
    }
  }

  function deleteelement(){
    $this->load->helper('get_clean_data_form');
    $this->load->model('delete_models');

    if(isset($_POST['data'])){

      $dataEvent = get_clean_data_form($_POST['data']);

      if($this->deleteDataInterface($dataEvent)){
        return true;
      }
    }
  }

  function updateDataInterface($dataEvent){
    $dataUpdateArr['status'] = $dataEvent['status'];

    $dataWhereArr[$dataEvent['column']] = $dataEvent['element_id'];

    return $this->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, $dataEvent['dbTableName']);
  }

  function deleteDataInterface($dataEvent){
    $dataWhereArr[$dataEvent['column']] = $dataEvent['element_id'];

    return $this->delete_models->delete_one_where_column($dataWhereArr, $dataEvent['dbTableName']);
  }
}