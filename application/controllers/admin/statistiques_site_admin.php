<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Statistiques_site_admin extends CI_Controller{

  private $who, $statistiqData, $commonStatistiqArr;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();

    $this->commonStatistiqArr = array('view' => 0, 'click' => 0, 'ctr' => 0, 'count_money' => 0);
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->helper('site_statistiq_default_data');
    $this->load->helper('extract_select_key_this_array');
    $this->load->helper('data_where_user_id');
    $this->load->helper('timestamp_of_date_formt');
    $this->load->helper('sort_arr_of_obj');
    $this->load->helper('curent_sort_builder');
    $this->load->helper('get_define_day');
    $this->load->library('statistiques/statistiques_count_data');
    $this->load->library('admin/search_id_url_mail');
    $this->load->library('admin/data_builder_site_statistiques_html_elements');
    $this->load->model('statistiques/statistiques_query');
    $this->load->model('statistiques/admin_statistiques_query');

    $data = template_builder('admin', 'statistiques_site_admin_tpl', $this->who);

    $data['statistiqData'] = $this->getStatistiqFormData();

    $data = $this->data_builder_site_statistiques_html_elements->data($data);

    $data['siteDataObj'] = $this->getSiteData();

    $data['totalStatistiq'] = $this->getCommonStatistiqCtrRur();

    $data['defineDay'] = get_define_day();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getStatistiqFormData(){
    $this->statistiqData = empty($_POST) ? site_statistiq_default_data() : $_POST;

    return $this->statistiqData;
  }

  function getSiteData(){
    $dataWhereArr = ( !empty($_POST['search']) ) ? $this->search_id_url_mail->getSearchData($_POST['search']) : array();

    return $this->setDataProcessing($this->admin_statistiques_query->select_all_row_where_foreach_column_selectcolumn_join($dataWhereArr, 'users lu', 'ls.user_id = lu.user_id', 'ls.site_id, ls.user_id, ls.url, lu.email', 'sites ls'));
  }

  function setDataProcessing($siteDataObj){

    if(is_array($siteDataObj)){

      foreach ($siteDataObj as $key => $currentSiteDataObj) {

        $this->statistiqData['site_id'] = $currentSiteDataObj->site_id;

        $statistiqCount =  $this->getSiteStatistiqDataArr();

        $siteDataObj[$key] = (object) array_merge( (array) $siteDataObj[$key], $statistiqCount);

        $this->totalStatistiq($statistiqCount);
      }

      return sort_arr_of_obj($siteDataObj, $this->statistiqData['sorter_column'], $this->statistiqData['sorter_by'] );
    }

    return false;
  }

  function getSiteStatistiqDataArr(){
    $statistiqConfig = array(
      'select_column' => 'site_id, url, view, click, money, dataadd',
      'table_name' => 'sites',
      'column_id' => 'site_id'
    );

    return $this->statistiques_count_data->getStatistiqCount($statistiqConfig, extract_select_key_this_array($this->statistiqData, array( 'search', 'date_start', 'date_end')));
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