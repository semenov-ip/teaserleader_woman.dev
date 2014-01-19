<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_statistiq_site_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

    $data['selectDataValue'] = select_define_builder( array($data['statistiqData']['url']), $this->getSiteDataAll($data['siteDataAllArrObj']), true );

    return $data;
  }

  function getSiteDataAll($siteDataAllArrObj){

    $getSiteDataAllKeyValue['-1'] = "Выберите сайт";
    
    foreach ($siteDataAllArrObj as $key => $siteDataCurentObj) {

      $getSiteDataAllKeyValue[$siteDataCurentObj->site_id] = $siteDataCurentObj->url;

    }

    return $getSiteDataAllKeyValue;
  }
}