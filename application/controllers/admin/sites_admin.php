<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Sites_admin extends CI_Controller{

  private $who;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index(){
    $this->load->helper('status/incite_status_site_teaser_name');
    $this->load->helper('wordwrap2');
    $this->load->helper('pagination_initialize');
    $this->load->helper('split_string');
    $this->load->library('admin/search_id_url_mail');
    $this->load->model('select_models');
    $this->load->model('pagination/site_pagination');

    $data = template_builder('admin','sites_admin_tpl',$this->who);

    $data['siteDataObj'] = $this->getSiteAllData();

    $this->load->view( '/_shared/admin_tpl.php', $data );
  }

  function getSiteAllData(){
    $perPagePagination = pagination_initialize('/index.php/admin/sites_admin/index/', $this->totalRows());

    return $this->setDataProcessing($this->site_pagination->select_all_row_where_foreach_column_selectcolumn_join_orderby_pagination($this->getDataWhereArr(), 'ls.status', 'asc', 'users lu', 'ls.user_id = lu.user_id', 'ls.site_id, ls.user_id, ls.status, ls.url, ls.stat_login, lu.email', $perPagePagination, intval($this->uri->segment(4)), 'sites ls'));
  }

  function totalRows(){
    return $this->site_pagination->select_all_row_where_foreach_column_selectcolumn_join_orderby_return_count($this->getDataWhereArr(), 'users lu', 'ls.user_id = lu.user_id', 'ls.site_id', 'sites ls');
  }

  function getDataWhereArr(){
    return ( !empty($_POST['search']) ) ? $this->search_id_url_mail->getSearchData($_POST['search']) : array();
  }

  function setDataProcessing($siteDataObj){
    if(is_array($siteDataObj)){

      foreach ($siteDataObj as $key => $currentSiteDataObj) {

        $currentSiteDataObj->status = incite_status_site_teaser_name($currentSiteDataObj->status);

        $currentSiteDataObj->stat_login = split_string($currentSiteDataObj->stat_login, 25);
      }

      return $siteDataObj;
    }

    return false;
  }
}