<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_site {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){
    $_POST = trim_stripslashes($_POST);

    if( $this->urlCleanCheckEmptyInputData() ) return "empty_url";

    if( $this->urlConfirmDb() ) return "url_confirm";

    if( $this->emptyStatLogin() ) return "empty_stat_login";

    return true;
  }

  function urlCleanCheckEmptyInputData(){
    if( empty($_POST['url']) ) { return true; }

    $_POST['url'] = str_replace('http://', '', $_POST['url']);

    if(substr($_POST['url'], 0, 4) == 'www.') { $_POST['url'] = substr($_POST['url'], 4); }

    if( substr($_POST['url'], (strlen($_POST['url']) - 1)) == '/'){ $_POST['url'] = substr($_POST['url'], 0, (strlen($_POST['url']) - 1)); }

    return false;
  }

  function urlConfirmDb(){
    $whereEmalData['url'] = $_POST['url'];

    return $this->ci->select_models->select_one_row_where_column($whereEmalData, 'sites');
  }

  function emptyStatLogin(){
    if($_POST['stat_login'] === "Адрес:\nЛогин:\nПароль:"){ return true; }

    return false;
  }
}