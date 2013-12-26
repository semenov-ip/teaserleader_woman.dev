<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_site {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData(){

    $_POST = trim_stripslashes($_POST);

    if( !$this->urlCleanCheckEmptyInputData() ) return "empty_url";

    if( $this->urlConfirmDb($_POST['url']) ) return "url_confirm";

    return true;
  }

  function urlCleanCheckEmptyInputData(){
    if( empty($_POST['url']) ) { return false; }

    $_POST['url'] = str_replace('http://', '', $_POST['url']);

    if(substr($_POST['url'], 0, 4) == 'www.') { $_POST['url'] = substr($_POST['url'], 4); }

    if( substr($_POST['url'], (strlen($_POST['url']) - 1)) == '/'){ $_POST['url'] = substr($_POST['url'], 0, (strlen($_POST['url']) - 1)); }

    return true;
  }

  function urlConfirmDb($urlUser){
    $whereEmalData['url'] = $urlUser;

    return $this->ci->select_models->select_one_row_where_column($whereEmalData, 'sites');
  }

}