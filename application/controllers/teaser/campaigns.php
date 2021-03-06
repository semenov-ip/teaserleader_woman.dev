<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Campaigns extends CI_Controller{

  private $who, $statistiqData, $commonStatistiqArr;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();


    $this->commonStatistiqArr = array('view' => 0, 'click' => 0, 'ctr' => 0, 'count_money' => 0);
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->helper('return_word_end');
    $this->load->helper('get_define_day');
    $this->load->helper('campaign_statistiq_default_data');
    $this->load->helper('extract_select_key_this_array');
    $this->load->helper('data_where_user_id');
    $this->load->helper('timestamp_of_date_formt');
    $this->load->helper('sort_arr_of_obj');
    $this->load->helper('wordwrap2');
    $this->load->helper('split_string');
    $this->load->helper('curent_sort_builder');
    $this->load->library('statistiques/statistiques_count_data');
    $this->load->library('teaser/data_builder_campaign_statistiques_html_elements');
    $this->load->model('statistiques/statistiques_query');

    $data = template_builder('admin','campaigns_tpl', $this->who);

    $data['statistiqData'] = $this->getStatistiqFormData();

    $data = $this->data_builder_campaign_statistiques_html_elements->data($data);

    $data['defineDay'] = get_define_day();

    $data['campaignDataObj'] = $this->getCampaignData();

    $data['totalStatistiq'] = $this->getCommonStatistiqCtrRur();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getStatistiqFormData(){
    $this->statistiqData = empty($_POST) ? campaign_statistiq_default_data() : $_POST;

    return $this->statistiqData;
  }

  function getCampaignData(){
    $dataWhereArr = data_where_user_id($this->who);

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'campaign_id, name, status', 'campaigns'));
  }

  function setDataProcessing($campaignDataObj){
    if(is_array($campaignDataObj)){

      foreach ($campaignDataObj as $key => $currentCampaignDataObj) {

        $campaignDataObj[$key]->playStatus = $currentCampaignDataObj->status == 0 ? "disabled" : "onclick=\"playPauseElement('".$currentCampaignDataObj->campaign_id."', 'campaign_id', '".$currentCampaignDataObj->status."', 'campaigns');\"";

        $currentCampaignDataObj->status = incite_status_site_teaser_name($currentCampaignDataObj->status);

        $campaignDataObj[$key]->countTeaser = return_word_end($this->select_models->select_count_where_fromtable(array('campaign_id' => $currentCampaignDataObj->campaign_id), 'teasers'), 'объявлен', 'ие', 'ия', 'ий');

        $currentCampaignDataObj->name = split_string($currentCampaignDataObj->name, 34);

        $this->statistiqData['campaign_id'] = $currentCampaignDataObj->campaign_id;

        $statistiqCount =  $this->getCampaignStatistiqDataArr();

        $campaignDataObj[$key] = (object) array_merge( (array) $campaignDataObj[$key], $statistiqCount);

        $this->totalStatistiq($statistiqCount);
      }
      return sort_arr_of_obj($campaignDataObj, $this->statistiqData['sorter_column'], $this->statistiqData['sorter_by'] );
    }

    return false;
  }

  function getCampaignStatistiqDataArr(){
    $statistiqConfig = array(
      'select_column' => 'campaign_id, view, click, money, dataadd',
      'table_name' => 'campaigns',
      'column_id' => 'campaign_id'
    );

    return $this->statistiques_count_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array($this->statistiqData, array('campaign_id', 'date_start', 'date_end')));
  }

  function totalStatistiq($statistiqCount){
    $this->commonStatistiqArr['view'] += $statistiqCount['view'];
    $this->commonStatistiqArr['click'] += $statistiqCount['click'];
    $this->commonStatistiqArr['count_money'] += $statistiqCount['count_money'];
  }

  function getCommonStatistiqCtrRur(){
    $this->commonStatistiqArr['ctr'] = str_replace(",", ".", @sprintf("%.2f", (100 / $this->commonStatistiqArr['view']) * $this->commonStatistiqArr['click']));

    $this->commonStatistiqArr['count_money'] = number_format($this->commonStatistiqArr['count_money'], 2, '.', '');

    return $this->commonStatistiqArr;
  }
}