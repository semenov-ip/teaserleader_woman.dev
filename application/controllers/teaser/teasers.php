<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Teasers extends CI_Controller{

  private $who, $campaignId, $statistiqData, $commonStatistiqArr;

  function __construct(){

    parent::__construct();

    $this->load->library('check_users_access');
    $this->who = $this->check_users_access->checkUsers();

    $this->commonStatistiqArr = array('view' => 0, 'click' => 0, 'ctr' => 0, 'count_money' => 0);
  }

  function index($campaignId=false){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->helper('return_word_end');
    $this->load->helper('get_define_day');
    $this->load->helper('campaign_statistiq_default_data');
    $this->load->helper('extract_select_key_this_array');
    $this->load->helper('data_where_user_id');
    $this->load->helper('timestamp_of_date_formt');
    $this->load->library('statistiques/statistiques_count_data');
    $this->load->model('statistiques/statistiques_query');

    $this->getCampaignId($campaignId);

    $data = template_builder('admin','teasers_tpl', $this->who);

    $data['statistiqData'] = $this->getStatistiqFormData();

    $data['defineDay'] = get_define_day();

    $data['teaserDataObj'] = $this->getTeaserData();

    $data['addTeaserButtonCampaignId'] = $this->campaignId;

    $data['totalStatistiq'] = $this->getCommonStatistiqCtrRur();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getCampaignId($campaignId){
    $this->campaignId = $campaignId;
  }

  function getStatistiqFormData(){
    $this->statistiqData = empty($_POST) ? campaign_statistiq_default_data() : $_POST;

    return $this->statistiqData;
  }

  function getTeaserData(){
    $dataWhereArr['user_id'] = extract_key_this_array($this->session->userdata('user'), 'user_id');
    if( $this->campaignId ) { $dataWhereArr['campaign_id'] = $this->campaignId; }

    return $this->setDataProcessing($this->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'teaser_id, image, url, text, status', 'teasers'));
  }

  function setDataProcessing($teaserDataObj){
    if(is_array($teaserDataObj)){

      foreach ($teaserDataObj as $key => $currentTeaserDataObj) {

        $teaserDataObj[$key]->playStatus = $currentTeaserDataObj->status == 0 ? "disabled" : "onclick=\"playPauseElement('".$currentTeaserDataObj->teaser_id."', 'teaser_id', '".$currentTeaserDataObj->status."', 'teasers');\"";

        $currentTeaserDataObj->status = incite_status_site_teaser_name($currentTeaserDataObj->status);

        $this->statistiqData['teaser_id'] = $currentTeaserDataObj->teaser_id;

        $statistiqCount =  $this->getTeaserStatistiqDataArr();

        $teaserDataObj[$key] = (object) array_merge( (array) $teaserDataObj[$key], $statistiqCount);

        $this->totalStatistiq($statistiqCount);

      }

      return $teaserDataObj;
    }

    return false;
  }

  function getTeaserStatistiqDataArr(){
    $statistiqConfig = array(
      'select_column' => 'teaser_id, view, click, money, dataadd',
      'table_name' => 'teasers',
      'column_id' => 'teaser_id'
    );

    return $this->statistiques_count_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array($this->statistiqData, array('teaser_id', 'date_start', 'date_end')));
  }

  function totalStatistiq($statistiqCount){
    $this->commonStatistiqArr['view'] += $statistiqCount['view'];
    $this->commonStatistiqArr['click'] += $statistiqCount['click'];
    $this->commonStatistiqArr['count_money'] += $statistiqCount['count_money'];
  }

  function getCommonStatistiqCtrRur(){
    $this->commonStatistiqArr['ctr'] = str_replace(",", ".", @sprintf("%.2f", (100 / $this->commonStatistiqArr['view']) * $this->commonStatistiqArr['click']));

    $this->commonStatistiqArr['count_money'] = number_format($this->commonStatistiqArr['count_money'], 2);

    return $this->commonStatistiqArr;
  }
}