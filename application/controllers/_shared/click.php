<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Click extends CI_Controller{

  function __construct(){
    parent::__construct();
  }

  function index($hash){
    $this->load->helper('extract_key_this_object');
    $this->load->helper('country_extratc_column_name_click');
    $this->load->model('select_models');
    $this->load->model('update_models');
    $this->load->model('ckick/ckick_query');
    $this->load->library('_shared/get_click_data');
    $this->load->library('_shared/click_balance_update_debit_credit');
    $this->load->library('_shared/click_count_statistiques');

    $clickData = $this->get_click_data->clickData($hash);

    $priceReferral = $this->click_balance_update_debit_credit->balanceUpdate($clickData);

    $this->click_count_statistiques->prepareStatisticsData($clickData, $priceReferral);
  }
}